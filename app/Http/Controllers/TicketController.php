<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use App\Models\RejectionReason;
use App\Models\Ticket;
use App\Models\User;
use App\Models\TicketPriority;
use App\Services\TicketStateMachine;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TicketController extends Controller
{
    public function __construct(private TicketStateMachine $stateMachine)
    {
    }

    public function index(Request $request): View
    {
        $this->authorize('viewAny', Ticket::class);

        $query = Ticket::with(['asset', 'priority']);

        if ($request->user()->can('tickets.view-all')) {
            $query->with(['creator']);
            if ($request->user()->hasRole('operator') && !$request->user()->hasRole('admin')) {
                $query->whereNotIn('status', ['rejected', 'cancelled']);
            }
        } else {
            $query->where('created_by', $request->user()->id);
        }

        $tickets = $query->latest()->paginate(15);

        return view('tickets.index', compact('tickets'));
    }

    public function create(Request $request): View
    {
        $this->authorize('create', Ticket::class);

        $myAssets = Asset::where('status', 'active')
            ->where('current_user_id', $request->user()->id)
            ->orderBy('name')
            ->get();

        $otherAssets = Asset::where('status', 'active')
            ->where(function ($query) use ($request) {
                $query->where('current_user_id', '!=', $request->user()->id)
                      ->orWhereNull('current_user_id');
            })
            ->orderBy('name')
            ->get();
            
        $preselectedAssetId = $request->query('asset_id');

        return view('tickets.create', compact('myAssets', 'otherAssets', 'preselectedAssetId'));
    }

    public function store(Request $request): RedirectResponse
    {
        $this->authorize('create', Ticket::class);

        $validated = $request->validate([
            'asset_id' => ['required', 'exists:assets,id'],
            'description' => ['required', 'string', 'max:2000'],
            'photo' => ['required', 'image', 'mimes:jpeg,png,jpg,webp,heic', 'max:4096'],
        ]);

        $path = $request->file('photo')->store('tickets/reports', 'public');

        $ticket = new Ticket([
            'asset_id' => $validated['asset_id'],
            'created_by' => $request->user()->id,
            'description' => $validated['description'],
            'photo_url' => $path,
            'status' => 'waiting_approval',
        ]);

        $ticket->ticket_number = $this->generateTicketNumber();
        $ticket->save();

        return redirect()->route('tickets.index')->with('success', 'Tiket berhasil dibuat, menunggu persetujuan admin.');
    }

    public function show(Ticket $ticket): View
    {
        $this->authorize('view', $ticket);

        $ticket->load(['asset', 'creator', 'assignedOperator', 'priority', 'rejectionReason', 'histories.actor']);
        $operators = User::role('operator')->get();
        $priorities = TicketPriority::where('is_active', true)->get();
        $rejectionReasons = RejectionReason::where('is_active', true)->get();

        return view('tickets.show', compact('ticket', 'operators', 'priorities', 'rejectionReasons'));
    }

    public function approve(Request $request, Ticket $ticket): RedirectResponse
    {
        $this->authorize('approve', $ticket);

        $validated = $request->validate([
            'assigned_operator_id' => ['required', 'exists:users,id'],
            'ticket_priority_id' => ['required', 'exists:ticket_priorities,id'],
        ]);

        $this->stateMachine->transitionTo($ticket, 'assigned', $request->user(), $validated);

        return back()->with('success', 'Tiket disetujui dan ditugaskan ke operator.');
    }

    public function reject(Request $request, Ticket $ticket): RedirectResponse
    {
        $this->authorize('reject', $ticket);

        $validated = $request->validate([
            'rejection_reason_id' => ['required', 'exists:rejection_reasons,id'],
        ]);

        $this->stateMachine->transitionTo($ticket, 'rejected', $request->user(), $validated);

        return back()->with('success', 'Tiket ditolak.');
    }

    public function startChecking(Request $request, Ticket $ticket): RedirectResponse
    {
        $this->authorize('updateStatus', $ticket);

        $this->stateMachine->transitionTo($ticket, 'checking', $request->user());

        return back()->with('success', 'Tiket mulai diperiksa.');
    }

    public function complete(Request $request, Ticket $ticket): RedirectResponse
    {
        $this->authorize('updateStatus', $ticket);

        $validated = $request->validate([
            'proof_photo' => ['required', 'image', 'mimes:jpeg,png,jpg,webp,heic', 'max:4096'],
        ]);

        $path = $request->file('proof_photo')->store('tickets/proofs', 'public');

        $this->stateMachine->transitionTo($ticket, 'completed', $request->user(), [
            'proof_photo_url' => $path,
        ]);

        return back()->with('success', 'Tiket ditandai selesai dikerjakan.');
    }

    public function close(Request $request, Ticket $ticket): RedirectResponse
    {
        $this->authorize('close', $ticket);

        $this->stateMachine->transitionTo($ticket, 'closed', $request->user());

        return back()->with('success', 'Tiket ditutup, terima kasih konfirmasinya.');
    }

    public function cancel(Request $request, Ticket $ticket): RedirectResponse
    {
        $this->authorize('cancel', $ticket);

        $this->stateMachine->transitionTo($ticket, 'cancelled', $request->user());

        return back()->with('success', 'Tiket dibatalkan.');
    }

    public function destroy(Ticket $ticket): RedirectResponse
    {
        $this->authorize('delete', $ticket);

        $ticket->delete();

        return redirect()->route('tickets.index')->with('success', 'Tiket berhasil dihapus (soft delete).');
    }

    private function generateTicketNumber(): string
    {
        $year = now()->year;

        $lastNumber = Ticket::where('ticket_number', 'like', "TK-{$year}-%")
            ->orderByDesc('ticket_number')
            ->value('ticket_number');

        $nextSequence = $lastNumber ? ((int) substr($lastNumber, -4)) + 1 : 1;

        return sprintf('TK-%d-%04d', $year, $nextSequence);
    }
}
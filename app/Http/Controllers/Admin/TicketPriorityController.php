<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TicketPriority;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TicketPriorityController extends Controller
{
    public function index(): View
    {
        $ticketPriorities = TicketPriority::orderBy('sla_hours')->paginate(10);

        return view('admin.ticket-priorities.index', compact('ticketPriorities'));
    }

    public function create(): View
    {
        return view('admin.ticket-priorities.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:ticket_priorities,name'],
            'sla_hours' => ['required', 'integer', 'min:1'],
        ]);

        TicketPriority::create([
            'name' => $validated['name'],
            'sla_hours' => $validated['sla_hours'],
            'is_active' => true,
        ]);

        return redirect()->route('admin.ticket-priorities.index')->with('success', 'Prioritas tiket berhasil ditambahkan.');
    }

    public function edit(TicketPriority $ticketPriority): View
    {
        return view('admin.ticket-priorities.edit', compact('ticketPriority'));
    }

    public function update(Request $request, TicketPriority $ticketPriority): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:ticket_priorities,name,' . $ticketPriority->id],
            'sla_hours' => ['required', 'integer', 'min:1'],
        ]);

        $ticketPriority->update($validated);

        return redirect()->route('admin.ticket-priorities.index')->with('success', 'Prioritas tiket berhasil diperbarui.');
    }

    public function toggleActive(TicketPriority $ticketPriority): RedirectResponse
    {
        $ticketPriority->update(['is_active' => ! $ticketPriority->is_active]);

        return redirect()->route('admin.ticket-priorities.index')->with('success', 'Status prioritas tiket berhasil diubah.');
    }
}
<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'total' => Ticket::count(),
            'waiting' => Ticket::where('status', 'waiting_approval')->count(),
            'in_progress' => Ticket::whereIn('status', ['assigned', 'checking'])->count(),
            'sla_breached' => Ticket::where('sla_breached', true)->count(),
        ];

        $tickets = Ticket::with(['asset', 'creator', 'priority'])
            ->latest()
            ->paginate(6);

        return view('admin.dashboard', compact('stats', 'tickets'));
    }
}
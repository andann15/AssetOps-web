<?php

namespace App\Policies;

use App\Models\Ticket;
use App\Models\User;

class TicketPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('tickets.view-all') || $user->can('tickets.view-own');
    }

    public function view(User $user, Ticket $ticket): bool
    {
        if ($user->can('tickets.view-all')) {
            return true;
        }

        return $user->can('tickets.view-own') && $ticket->created_by === $user->id;
    }

    public function create(User $user): bool
    {
        return $user->can('tickets.create');
    }

    public function approve(User $user, Ticket $ticket): bool
    {
        return $user->can('tickets.approve') && $ticket->status === 'waiting_approval';
    }

    public function reject(User $user, Ticket $ticket): bool
    {
        return $user->can('tickets.reject') && $ticket->status === 'waiting_approval';
    }

    public function updateStatus(User $user, Ticket $ticket): bool
    {
        return $user->can('tickets.update-status')
            && $ticket->assigned_operator_id === $user->id
            && in_array($ticket->status, ['assigned', 'checking'], true);
    }

    public function close(User $user, Ticket $ticket): bool
    {
        return $user->can('tickets.close')
            && $ticket->created_by === $user->id
            && $ticket->status === 'completed';
    }

    public function cancel(User $user, Ticket $ticket): bool
    {
        return $user->can('tickets.cancel')
            && $ticket->created_by === $user->id
            && $ticket->status === 'waiting_approval';
    }

    public function delete(User $user, Ticket $ticket): bool
    {
        // Only admins can delete tickets
        return $user->hasRole('admin');
    }
}
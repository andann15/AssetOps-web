<?php

namespace App\Services;

use App\Models\Ticket;
use App\Models\TicketHistory;
use App\Models\TicketPriority;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use InvalidArgumentException;
use RuntimeException;

class TicketStateMachine
{
    private const TRANSITIONS = [
        'waiting_approval' => ['assigned', 'rejected', 'cancelled'],
        'assigned' => ['checking'],
        'checking' => ['completed'],
        'completed' => ['closed'],
        'rejected' => [],
        'cancelled' => [],
        'closed' => [],
    ];

    public function transitionTo(Ticket $ticket, string $toStatus, User $actor, array $extra = []): Ticket
    {
        $fromStatus = $ticket->status;

        $this->assertTransitionAllowed($fromStatus, $toStatus);
        $this->assertActorAllowed($ticket, $toStatus, $actor);

        return DB::transaction(function () use ($ticket, $fromStatus, $toStatus, $actor, $extra) {
            $this->applyTransitionData($ticket, $toStatus, $extra);

            $ticket->status = $toStatus;
            $ticket->save();

            TicketHistory::create([
                'ticket_id' => $ticket->id,
                'actor_id' => $actor->id,
                'status_from' => $fromStatus,
                'status_to' => $toStatus,
            ]);

            return $ticket;
        });
    }

    private function assertTransitionAllowed(string $fromStatus, string $toStatus): void
    {
        $allowed = self::TRANSITIONS[$fromStatus] ?? [];

        if (! in_array($toStatus, $allowed, true)) {
            throw new InvalidArgumentException("Tidak bisa pindah dari status [{$fromStatus}] ke [{$toStatus}].");
        }
    }

    private function assertActorAllowed(Ticket $ticket, string $toStatus, User $actor): void
    {
        $isAllowed = match ($toStatus) {
            'assigned' => $actor->can('tickets.approve'),
            'rejected' => $actor->can('tickets.reject'),
            'checking', 'completed' => $actor->can('tickets.update-status')
                && $ticket->assigned_operator_id === $actor->id,
            'closed' => $actor->can('tickets.close')
                && $ticket->created_by === $actor->id,
            'cancelled' => $actor->can('tickets.cancel')
                && $ticket->created_by === $actor->id,
            default => false,
        };

        if (! $isAllowed) {
            throw new RuntimeException("User [{$actor->id}] tidak berhak memindahkan tiket ke status [{$toStatus}].");
        }
    }

    private function applyTransitionData(Ticket $ticket, string $toStatus, array $extra): void
    {
        match ($toStatus) {
            'assigned' => $this->applyAssignedData($ticket, $extra),
            'rejected' => $this->applyRejectedData($ticket, $extra),
            'completed' => $this->applyCompletedData($ticket, $extra),
            default => null,
        };
    }

    private function applyAssignedData(Ticket $ticket, array $extra): void
    {
        if (empty($extra['assigned_operator_id'])) {
            throw new InvalidArgumentException('assigned_operator_id wajib diisi saat status berubah ke assigned.');
        }

        $ticket->assigned_operator_id = $extra['assigned_operator_id'];

        if (! empty($extra['ticket_priority_id'])) {
            $ticket->ticket_priority_id = $extra['ticket_priority_id'];

            $priority = TicketPriority::find($extra['ticket_priority_id']);
            if ($priority) {
                $ticket->sla_deadline = now()->addHours($priority->sla_hours);
            }
        }
    }

    private function applyRejectedData(Ticket $ticket, array $extra): void
    {
        if (empty($extra['rejection_reason_id'])) {
            throw new InvalidArgumentException('rejection_reason_id wajib diisi saat tiket ditolak.');
        }

        $ticket->rejection_reason_id = $extra['rejection_reason_id'];
    }

    private function applyCompletedData(Ticket $ticket, array $extra): void
    {
        if (empty($extra['proof_photo_url'])) {
            throw new InvalidArgumentException('proof_photo_url wajib diisi saat tiket selesai dikerjakan.');
        }

        $ticket->proof_photo_url = $extra['proof_photo_url'];
    }
}
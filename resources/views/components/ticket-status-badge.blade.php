@php
    $colors = [
        'waiting_approval' => 'bg-yellow-100 text-yellow-800',
        'assigned' => 'bg-blue-100 text-blue-800',
        'checking' => 'bg-blue-100 text-blue-800',
        'completed' => 'bg-purple-100 text-purple-800',
        'closed' => 'bg-green-100 text-green-800',
        'rejected' => 'bg-red-100 text-red-800',
        'cancelled' => 'bg-gray-100 text-gray-600',
    ];
    $labels = [
        'waiting_approval' => 'Menunggu Persetujuan',
        'assigned' => 'Ditugaskan',
        'checking' => 'Diperiksa',
        'completed' => 'Selesai Dikerjakan',
        'closed' => 'Ditutup',
        'rejected' => 'Ditolak',
        'cancelled' => 'Dibatalkan',
    ];
@endphp
<span class="px-2 py-1 text-xs rounded {{ $colors[$status] ?? 'bg-gray-100 text-gray-600' }}">
    {{ $labels[$status] ?? $status }}
</span>
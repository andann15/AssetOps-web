<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Daftar Tiket') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-[0_8px_30px_rgb(0,0,0,0.04)] sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium">
                        {{ auth()->user()->can('tickets.view-all') ? 'Semua Tiket' : 'Tiket Saya' }}
                    </h3>
                    @can('create', App\Models\Ticket::class)
                        <a href="{{ route('tickets.create') }}" class="px-4 py-2 bg-sidebar text-white hover:bg-orange-500 hover:text-white transition-colors duration-200 border border-transparent hover:bg-brand/90 border border-transparent text-white rounded ">
                            Buat Tiket
                        </a>
                    @endcan
                </div>

                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">No. Tiket</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Pembuat</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Aset</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Deskripsi</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Prioritas</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Status</th>
                            <th class="px-4 py-2 text-left text-sm font-medium text-gray-500">Dibuat</th>
                            <th class="px-4 py-2 text-right text-sm font-medium text-gray-500">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-200">
                        @forelse ($tickets as $ticket)
                            <tr>
                                <td class="px-4 py-3 font-medium">{{ $ticket->ticket_number ?? '-' }}</td>
                                <td class="px-4 py-3">
                                    <div class="font-medium text-gray-900">{{ $ticket->creator->name ?? '-' }}</div>
                                    <div class="text-xs text-gray-500">{{ $ticket->creator->division->name ?? 'Tanpa Divisi' }}</div>
                                </td>
                                <td class="px-4 py-3">{{ $ticket->asset->name }}</td>
                                <td class="px-4 py-3">{{ Str::limit($ticket->description, 50) }}</td>
                                <td class="px-4 py-3">{{ $ticket->priority->name ?? '-' }}</td>
                                <td class="px-4 py-3"><x-ticket-status-badge :status="$ticket->status" /></td>
                                <td class="px-4 py-3">{{ $ticket->created_at->format('d M Y H:i') }}</td>
                                <td class="px-4 py-3 text-right flex justify-end gap-2">
                                    <a href="{{ route('tickets.show', $ticket) }}" class="text-blue-600 hover:underline">Detail</a>
                                    @can('delete', $ticket)
                                        <form action="{{ route('tickets.destroy', $ticket) }}" method="POST" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus tiket ini?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:underline">Hapus</button>
                                        </form>
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="px-4 py-3 text-center text-gray-500">Belum ada tiket.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>

                <div class="mt-4">
                    {{ $tickets->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
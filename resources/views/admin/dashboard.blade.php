<x-app-layout>
    <x-slot name="header">
        <div>
            <h2 class="font-semibold text-lg text-gray-800 leading-tight">
                {{ __('Dashboard Pemeliharaan') }}
            </h2>
            <p class="text-sm text-gray-500">Ringkasan aset dan tiket pemeliharaan.</p>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">

            @if (session('success'))
                <div class="p-3 bg-green-100 text-green-800 text-sm rounded">{{ session('success') }}</div>
            @endif

            <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                <div class="bg-white rounded-lg shadow-[0_8px_30px_rgb(0,0,0,0.04)] border-l-4 border-orange-500 p-4 hover:-translate-y-1.5 hover:shadow-lg transition-all duration-300 ease-in-out cursor-pointer">
                    <p class="text-xs text-gray-500">Total Tiket</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $stats['total'] }}</p>
                </div>
                <div class="bg-white rounded-lg shadow-[0_8px_30px_rgb(0,0,0,0.04)] border-l-4 border-yellow-500 p-4 hover:-translate-y-1.5 hover:shadow-lg transition-all duration-300 ease-in-out cursor-pointer">
                    <p class="text-xs text-gray-500">Menunggu Persetujuan</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $stats['waiting'] }}</p>
                </div>
                <div class="bg-white rounded-lg shadow-[0_8px_30px_rgb(0,0,0,0.04)] border-l-4 border-blue-500 p-4 hover:-translate-y-1.5 hover:shadow-lg transition-all duration-300 ease-in-out cursor-pointer">
                    <p class="text-xs text-gray-500">Sedang Dikerjakan</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $stats['in_progress'] }}</p>
                </div>
                <div class="bg-white rounded-lg shadow-[0_8px_30px_rgb(0,0,0,0.04)] border-l-4 border-red-500 p-4 hover:-translate-y-1.5 hover:shadow-lg transition-all duration-300 ease-in-out cursor-pointer">
                    <p class="text-xs text-gray-500">SLA Terlambat</p>
                    <p class="text-2xl font-bold text-gray-800">{{ $stats['sla_breached'] }}</p>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-[0_8px_30px_rgb(0,0,0,0.04)] overflow-hidden">
                <div class="px-4 py-3 border-b border-gray-100">
                    <h3 class="text-sm font-semibold text-gray-700">Tiket Terbaru</h3>
                </div>
                <table class="min-w-full divide-y divide-gray-100">
                    <thead>
                        <tr>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">No. Tiket</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Nama Aset</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Pelapor</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Prioritas</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Status</th>
                            <th class="px-4 py-2 text-left text-xs font-medium text-gray-500">Dibuat</th>
                            <th class="px-4 py-2 text-right text-xs font-medium text-gray-500">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse ($tickets as $ticket)
                            <tr>
                                <td class="px-4 py-2 text-sm text-gray-700">TKT-{{ strtoupper(substr($ticket->id, 0, 8)) }}</td>
                                <td class="px-4 py-2 text-sm text-gray-700">{{ $ticket->asset->name }}</td>
                                <td class="px-4 py-2 text-sm text-gray-700">{{ $ticket->creator->name }}</td>
                                <td class="px-4 py-2"><x-ticket-priority-dot :priority="$ticket->priority->name ?? null" /></td>
                                <td class="px-4 py-2"><x-ticket-status-badge :status="$ticket->status" /></td>
                                <td class="px-4 py-2 text-sm text-gray-500">{{ $ticket->created_at->format('d M Y') }}</td>
                                <td class="px-4 py-2 text-right">
                                    <a href="{{ route('tickets.show', $ticket) }}" class="text-blue-600 hover:underline text-sm">Detail</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-4 py-4 text-center text-sm text-gray-500">Belum ada tiket.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                <div class="px-4 py-3 border-t border-gray-100">
                    {{ $tickets->links() }}
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-[0_8px_30px_rgb(0,0,0,0.04)] p-4">
                <h3 class="text-sm font-semibold text-gray-700 mb-3">Akses Cepat</h3>
                <div class="flex flex-wrap gap-3 text-sm">
                    <a href="{{ route('tickets.index') }}" class="px-4 py-2 bg-brand text-sidebar rounded-md font-medium text-sm hover:bg-brand/90 transition flex items-center gap-2">Kelola Tiket</a>
                    <a href="{{ route('admin.assets.index') }}" class="px-4 py-2 border border-gray-200 text-gray-600 rounded-md font-medium text-sm hover:border-brand hover:text-brand transition flex items-center gap-2">Kelola Aset</a>
                    <a href="{{ route('admin.work-units.index') }}" class="px-4 py-2 border border-gray-200 text-gray-600 rounded-md font-medium text-sm hover:border-brand hover:text-brand transition flex items-center gap-2">Kelola Unit Kerja</a>
                    <a href="{{ route('admin.asset-categories.index') }}" class="px-4 py-2 border border-gray-200 text-gray-600 rounded-md font-medium text-sm hover:border-brand hover:text-brand transition flex items-center gap-2">Kelola Kategori Aset</a>
                    <a href="{{ route('admin.ticket-priorities.index') }}" class="px-4 py-2 border border-gray-200 text-gray-600 rounded-md font-medium text-sm hover:border-brand hover:text-brand transition flex items-center gap-2">Kelola Prioritas Tiket</a>
                    <a href="{{ route('admin.rejection-reasons.index') }}" class="px-4 py-2 border border-gray-200 text-gray-600 rounded-md font-medium text-sm hover:border-brand hover:text-brand transition flex items-center gap-2">Kelola Alasan Penolakan</a>
                    <a href="{{ route('admin.brands.index') }}" class="px-4 py-2 border border-gray-200 text-gray-600 rounded-md font-medium text-sm hover:border-brand hover:text-brand transition flex items-center gap-2">Kelola Merek</a>
                    <a href="{{ route('admin.locations.index') }}" class="px-4 py-2 border border-gray-200 text-gray-600 rounded-md font-medium text-sm hover:border-brand hover:text-brand transition flex items-center gap-2">Kelola Lokasi</a>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
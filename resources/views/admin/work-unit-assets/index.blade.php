<x-app-layout>
    <x-slot name="header">
        <x-ui.page-header title="Monitoring Aset Unit Kerja" description="Pantau daftar aset/rombongan aset yang ditugaskan ke Unit Kerja.">
            <x-slot name="action">
                <a href="{{ route('admin.work-unit-assets.export') }}" class="group inline-flex items-center gap-2 px-4 py-2 bg-brand text-sidebar hover:bg-brand/90 transition-colors duration-200 rounded-lg shadow-sm font-medium text-sm">
                    <svg class="w-4 h-4 group-hover:scale-110 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                    Unduh Laporan (CSV)
                </a>
            </x-slot>
        </x-ui.page-header>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">
            <x-ui.card :padded="false">
                <div class="p-4 border-b border-gray-100 flex justify-between items-center bg-gray-50/50">
                    <form method="GET" action="{{ route('admin.work-unit-assets.index') }}" class="flex items-center gap-2">
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                            </div>
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari aset atau unit kerja..." class="pl-10 rounded-lg border-gray-200 text-sm focus:ring-brand focus:border-brand w-64">
                        </div>
                        <button type="submit" class="px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 rounded-lg text-sm font-medium transition-colors">Cari</button>
                    </form>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-100">
                        <thead>
                            <tr class="bg-gray-50">
                                <th class="px-5 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Aset</th>
                                <th class="px-5 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Unit Kerja</th>
                                <th class="px-5 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Lokasi</th>
                                <th class="px-5 py-3 text-left text-xs font-bold text-gray-500 uppercase tracking-wider">Keterangan</th>
                                <th class="px-5 py-3 text-right text-xs font-bold text-gray-500 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 bg-white">
                            @forelse ($assets as $asset)
                                <tr class="hover:bg-slate-50 transition-colors duration-200">
                                    <td class="px-5 py-4">
                                        <div class="flex flex-col">
                                            <span class="font-bold text-slate-900">{{ $asset->name }}</span>
                                            <span class="text-xs text-gray-500 font-mono mt-0.5">Kode: {{ $asset->code }}</span>
                                        </div>
                                    </td>
                                    <td class="px-5 py-4">
                                        <div class="flex flex-col">
                                            <span class="text-sm font-medium text-gray-800">{{ $asset->workUnit->name ?? '-' }}</span>
                                            <span class="text-xs text-gray-500 mt-0.5">{{ $asset->workUnit->department->name ?? '-' }} / {{ $asset->workUnit->department->compartment->name ?? '-' }}</span>
                                        </div>
                                    </td>
                                    <td class="px-5 py-4 text-sm text-gray-700">
                                        {{ $asset->location->name ?? '-' }}
                                    </td>
                                    <td class="px-5 py-4 text-sm text-gray-700 max-w-xs truncate" title="{{ $asset->notes }}">
                                        {{ $asset->notes ?: '-' }}
                                    </td>
                                    <td class="px-5 py-4 text-right">
                                        @if($asset->status === 'active')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-emerald-100 text-emerald-800">Aktif Digunakan</span>
                                        @elseif($asset->status === 'in_storage')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">Di Gudang</span>
                                        @elseif($asset->status === 'maintenance')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-amber-100 text-amber-800">Dalam Perbaikan</span>
                                        @elseif($asset->status === 'damaged')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">Rusak</span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">Dihapuskan</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-5 py-12 text-center text-gray-500">
                                        <svg class="mx-auto h-12 w-12 text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 002-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                                        <p class="text-base font-medium text-gray-900">Belum ada aset unit kerja</p>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                @if($assets->hasPages())
                    <div class="px-5 py-3 border-t border-gray-100">
                        {{ $assets->links() }}
                    </div>
                @endif
            </x-ui.card>
        </div>
    </div>
</x-app-layout>

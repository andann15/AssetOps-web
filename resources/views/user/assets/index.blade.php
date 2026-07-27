<x-app-layout>
    <x-slot name="header">
        <x-ui.page-header title="Aset Saya" description="Daftar aset yang ditugaskan kepada Anda.">
            <x-slot name="action">
                <x-ui.button href="{{ route('tickets.create') }}">+ Buat Tiket Keluhan</x-ui.button>
            </x-slot>
        </x-ui.page-header>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-4">
            <x-ui.card :padded="false">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 p-6">
                    @forelse ($assets as $asset)
                        <div class="bg-white border rounded-xl p-5 shadow-sm hover:shadow-md transition-shadow">
                            <div class="flex justify-between items-start mb-4">
                                <div>
                                    <h3 class="text-lg font-bold text-gray-900">{{ $asset->name }}</h3>
                                    <p class="text-sm text-gray-500">{{ $asset->code }}</p>
                                </div>
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-50 text-blue-600 border border-blue-100">
                                    {{ $asset->category->name }}
                                </span>
                            </div>
                            
                            <div class="space-y-2 text-sm text-gray-600 mb-6">
                                <div class="flex justify-between">
                                    <span class="text-gray-400">Merek:</span>
                                    <span class="font-medium">{{ $asset->brand->name ?? '-' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-400">Model:</span>
                                    <span class="font-medium">{{ $asset->model ?? '-' }}</span>
                                </div>
                                <div class="flex justify-between">
                                    <span class="text-gray-400">Lokasi:</span>
                                    <span class="font-medium">{{ $asset->location->name ?? '-' }}</span>
                                </div>
                            </div>
                            
                            <div class="pt-4 border-t border-gray-100">
                                <a href="{{ route('tickets.create', ['asset_id' => $asset->id]) }}" class="inline-flex items-center justify-center w-full px-4 py-2 bg-sidebar text-white hover:bg-orange-500 hover:text-white transition-colors duration-200 border border-transparent rounded-lg font-medium text-sm">
                                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                    Lapor Kerusakan
                                </a>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full py-12 text-center text-gray-500">
                            <svg class="w-12 h-12 mx-auto text-gray-300 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                            <p>Anda belum memiliki aset yang ditugaskan kepada Anda.</p>
                        </div>
                    @endforelse
                </div>
            </x-ui.card>
            <div>{{ $assets->links() }}</div>
        </div>
    </div>
</x-app-layout>

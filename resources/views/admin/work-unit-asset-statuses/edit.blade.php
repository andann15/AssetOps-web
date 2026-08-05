<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.work-unit-asset-statuses.index') }}" class="text-gray-500 hover:text-gray-700 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Edit Status</h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-lg mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-[0_8px_30px_rgb(0,0,0,0.04)] sm:rounded-lg p-6">
                <form method="POST" action="{{ route('admin.work-unit-asset-statuses.update', $workUnitAssetStatus) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama Status</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $workUnitAssetStatus->name) }}"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" autofocus>
                        @error('name')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4">
                        <label for="order" class="block text-sm font-medium text-gray-700">Urutan Tampil</label>
                        <input type="number" name="order" id="order" value="{{ old('order', $workUnitAssetStatus->order) }}" min="0"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
                        <p class="text-xs text-gray-500 mt-1">Angka kecil = tampil lebih awal di dropdown.</p>
                        @error('order')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="mb-4 p-3 bg-gray-50 rounded-md">
                        <p class="text-xs text-gray-500">Slug (kunci tersimpan di database): <span class="font-mono font-semibold text-gray-700">{{ $workUnitAssetStatus->slug }}</span></p>
                        <p class="text-xs text-gray-400 mt-0.5">Slug tidak dapat diubah untuk menjaga konsistensi data.</p>
                    </div>
                    <div class="flex justify-end gap-2 mt-6">
                        <a href="{{ route('admin.work-unit-asset-statuses.index') }}" class="px-4 py-2 border rounded text-gray-600 hover:bg-gray-50">Batal</a>
                        <button type="submit" class="px-4 py-2 bg-sidebar text-white hover:bg-orange-500 rounded transition-colors">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

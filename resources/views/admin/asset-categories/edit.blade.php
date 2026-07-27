<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.asset-categories.index') }}" class="text-gray-500 hover:text-gray-700 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Kategori Aset') }}
        </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-[0_8px_30px_rgb(0,0,0,0.04)] sm:rounded-lg p-6">
                <form method="POST" action="{{ route('admin.asset-categories.update', $assetCategory) }}">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label for="name" class="block text-sm font-medium text-gray-700">Nama Kategori</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $assetCategory->name) }}"
                               class="mt-1 block w-full border-gray-300 rounded-md shadow-[0_8px_30px_rgb(0,0,0,0.04)]">
                        @error('name')
                            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-end gap-2">
                        <a href="{{ route('admin.asset-categories.index') }}" class="px-4 py-2 border rounded">Batal</a>
                        <button type="submit" class="px-4 py-2 bg-sidebar text-white hover:bg-orange-500 border border-transparent rounded transition-colors ">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
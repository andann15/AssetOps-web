<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('admin.assets.index') }}" class="text-gray-500 hover:text-gray-700 transition-colors">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Aset') }}
        </h2>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-[0_8px_30px_rgb(0,0,0,0.04)] sm:rounded-lg p-6">
                <form method="POST" action="{{ route('admin.assets.update', $asset) }}">
                    @csrf
                    @method('PUT')
                    @include('admin.assets._form')

                    <div class="flex justify-end gap-2 mt-6">
                        <a href="{{ route('admin.assets.index') }}" class="px-4 py-2 border rounded">Batal</a>
                        <button type="submit" class="px-4 py-2 bg-sidebar text-white hover:bg-orange-500 border border-transparent rounded transition-colors ">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
<x-app-layout>
    <x-slot name="header">
        <x-ui.page-header title="Edit Divisi" />
    </x-slot>

    <div class="py-6">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <x-ui.card>
                <form method="POST" action="{{ route('admin.divisions.update', $division) }}" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Divisi</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $division->name) }}"
                               class="block w-full rounded-md border-gray-300 shadow-[0_8px_30px_rgb(0,0,0,0.04)] focus:border-orange-400 focus:ring-orange-400 text-sm">
                        @error('name') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="flex justify-end gap-2 pt-2">
                        <x-ui.button variant="secondary" href="{{ route('admin.divisions.index') }}">Batal</x-ui.button>
                        <x-ui.button type="submit">Simpan Perubahan</x-ui.button>
                    </div>
                </form>
            </x-ui.card>
        </div>
    </div>
</x-app-layout>
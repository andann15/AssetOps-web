<x-app-layout>
    <x-slot name="header">
        <x-ui.page-header title="Tambah Alasan Penolakan" />
    </x-slot>

    <div class="py-6">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <x-ui.card>
                <form method="POST" action="{{ route('admin.rejection-reasons.store') }}" class="space-y-4">
                    @csrf
                    <div>
                        <label for="label" class="block text-sm font-medium text-gray-700 mb-1">Label Alasan</label>
                        <input type="text" name="label" id="label" value="{{ old('label') }}"
                               class="block w-full rounded-md border-gray-300 shadow-[0_8px_30px_rgb(0,0,0,0.04)] focus:border-orange-400 focus:ring-orange-400 text-sm">
                        @error('label') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="flex justify-end gap-2 pt-2">
                        <x-ui.button variant="secondary" href="{{ route('admin.rejection-reasons.index') }}">Batal</x-ui.button>
                        <x-ui.button type="submit">Simpan</x-ui.button>
                    </div>
                </form>
            </x-ui.card>
        </div>
    </div>
</x-app-layout>
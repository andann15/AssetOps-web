<x-app-layout>
    <x-slot name="header">
        <x-ui.page-header title="Edit Prioritas Tiket" />
    </x-slot>

    <div class="py-6">
        <div class="max-w-xl mx-auto sm:px-6 lg:px-8">
            <x-ui.card>
                <form method="POST" action="{{ route('admin.ticket-priorities.update', $ticketPriority) }}" class="space-y-4">
                    @csrf
                    @method('PUT')
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama Prioritas</label>
                        <input type="text" name="name" id="name" value="{{ old('name', $ticketPriority->name) }}"
                               class="block w-full rounded-md border-gray-300 shadow-[0_8px_30px_rgb(0,0,0,0.04)] focus:border-orange-400 focus:ring-orange-400 text-sm">
                        @error('name') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div>
                        <label for="sla_hours" class="block text-sm font-medium text-gray-700 mb-1">SLA (jam)</label>
                        <input type="number" name="sla_hours" id="sla_hours" value="{{ old('sla_hours', $ticketPriority->sla_hours) }}" min="1"
                               class="block w-full rounded-md border-gray-300 shadow-[0_8px_30px_rgb(0,0,0,0.04)] focus:border-orange-400 focus:ring-orange-400 text-sm">
                        @error('sla_hours') <p class="text-sm text-red-600 mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="flex justify-end gap-2 pt-2">
                        <x-ui.button variant="secondary" href="{{ route('admin.ticket-priorities.index') }}">Batal</x-ui.button>
                        <x-ui.button type="submit">Simpan Perubahan</x-ui.button>
                    </div>
                </form>
            </x-ui.card>
        </div>
    </div>
</x-app-layout>
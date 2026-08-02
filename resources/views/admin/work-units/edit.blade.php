<x-app-layout>
    <x-slot name="header">
        <x-ui.page-header title="Edit Unit Kerja" description="Ubah data Unit Kerja yang sudah ada.">
            <x-slot name="action">
                <x-ui.button href="{{ route('admin.work-units.index') }}" variant="secondary">&larr; Kembali</x-ui.button>
            </x-slot>
        </x-ui.page-header>
    </x-slot>

    <div class="py-6">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <x-ui.card>
                <form method="POST" action="{{ route('admin.work-units.update', $workUnit) }}" class="space-y-5">
                    @csrf
                    @method('PUT')

                    {{-- Kompartemen filter --}}
                    <div>
                        <label class="block text-sm font-semibold text-gray-700 mb-1.5">Kompartemen</label>
                        <select id="compartment_filter" class="w-full rounded-lg border border-gray-200 px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500">
                            <option value="">-- Semua Kompartemen --</option>
                            @foreach ($compartments as $comp)
                                <option value="{{ $comp->id }}" {{ $workUnit->department->compartment_id == $comp->id ? 'selected' : '' }}>
                                    {{ $comp->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Departemen --}}
                    <div>
                        <label for="department_id" class="block text-sm font-semibold text-gray-700 mb-1.5">Departemen <span class="text-red-500">*</span></label>
                        <select id="department_id" name="department_id" required
                            class="w-full rounded-lg border border-gray-200 px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 @error('department_id') border-red-400 @enderror">
                            @foreach ($departments as $dept)
                                <option value="{{ $dept->id }}" data-compartment="{{ $dept->compartment_id }}" {{ $workUnit->department_id == $dept->id ? 'selected' : '' }}>
                                    {{ $dept->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('department_id') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    {{-- Nama Unit Kerja --}}
                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-1.5">Nama Unit Kerja <span class="text-red-500">*</span></label>
                        <input type="text" id="name" name="name" value="{{ old('name', $workUnit->name) }}" required
                            class="w-full rounded-lg border border-gray-200 px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 @error('name') border-red-400 @enderror">
                        @error('name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div class="pt-2">
                        <button type="submit" class="w-full bg-[#0B1E36] text-white rounded-lg px-4 py-2.5 text-sm font-semibold hover:bg-orange-500 transition-colors">
                            Perbarui Unit Kerja
                        </button>
                    </div>
                </form>
            </x-ui.card>
        </div>
    </div>

    <script>
        const compartmentFilter = document.getElementById('compartment_filter');
        const deptSelect = document.getElementById('department_id');
        const allDepts = Array.from(deptSelect.options);

        compartmentFilter.addEventListener('change', function () {
            const selectedComp = this.value;
            deptSelect.innerHTML = '';
            allDepts.forEach(opt => {
                if (!opt.value) return;
                if (!selectedComp || opt.dataset.compartment === selectedComp) {
                    deptSelect.appendChild(opt.cloneNode(true));
                }
            });
        });
    </script>
</x-app-layout>

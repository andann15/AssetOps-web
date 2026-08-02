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
                <form method="POST" action="{{ route('admin.work-units.update', $workUnit) }}" class="space-y-5" x-data="{ newCompartment: false, newDepartment: false }">
                    @csrf
                    @method('PUT')

                    {{-- Kompartemen filter --}}
                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <label class="block text-sm font-semibold text-gray-700">Kompartemen</label>
                            <button type="button" @click="newCompartment = !newCompartment; if(newCompartment) newDepartment = true;" class="text-xs font-semibold text-blue-600 hover:underline" x-text="newCompartment ? 'Pilih yang Ada' : '+ Tambah Baru'"></button>
                        </div>
                        
                        <div x-show="!newCompartment">
                            <select id="compartment_filter" name="compartment_id" class="w-full rounded-lg border border-gray-200 px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500">
                                <option value="">-- Semua Kompartemen --</option>
                                @foreach ($compartments as $comp)
                                    <option value="{{ $comp->id }}" {{ $workUnit->department->compartment_id == $comp->id ? 'selected' : '' }}>
                                        {{ $comp->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div x-show="newCompartment" style="display: none;">
                            <input type="text" name="new_compartment_name" placeholder="Ketik nama kompartemen baru..." value="{{ old('new_compartment_name') }}" class="w-full rounded-lg border border-gray-200 px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 @error('new_compartment_name') border-red-400 @enderror">
                            @error('new_compartment_name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>
                    </div>

                    {{-- Departemen --}}
                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <label for="department_id" class="block text-sm font-semibold text-gray-700">Departemen <span class="text-red-500">*</span></label>
                            <button type="button" x-show="!newCompartment" @click="newDepartment = !newDepartment" class="text-xs font-semibold text-blue-600 hover:underline" x-text="newDepartment ? 'Pilih yang Ada' : '+ Tambah Baru'"></button>
                        </div>

                        <div x-show="!newDepartment">
                            <select id="department_id" name="department_id"
                                class="w-full rounded-lg border border-gray-200 px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 @error('department_id') border-red-400 @enderror">
                                @foreach ($departments as $dept)
                                    <option value="{{ $dept->id }}" data-compartment="{{ $dept->compartment_id }}" {{ $workUnit->department_id == $dept->id ? 'selected' : '' }}>
                                        {{ $dept->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('department_id') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>
                        <div x-show="newDepartment" style="display: none;">
                            <input type="text" name="new_department_name" placeholder="Ketik nama departemen baru..." value="{{ old('new_department_name') }}" class="w-full rounded-lg border border-gray-200 px-3 py-2 text-sm focus:ring-2 focus:ring-blue-500 @error('new_department_name') border-red-400 @enderror">
                            @error('new_department_name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>
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

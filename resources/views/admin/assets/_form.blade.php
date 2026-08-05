@php
    $asset = $asset ?? null;
@endphp

<div class="grid grid-cols-2 gap-4">
    <div class="mb-4 col-span-2">
        <label for="code" class="block text-sm font-medium text-gray-700">
            Kode Aset <span class="text-xs text-gray-400 font-normal ml-1">(Opsional — akan digenerate otomatis jika dikosongkan)</span>
        </label>
        <input type="text" name="code" id="code" value="{{ old('code', $asset->code ?? '') }}"
               placeholder="Contoh: ASET-2026-0001 (atau kosongkan untuk auto-generate)"
               class="mt-1 block w-full border-gray-300 rounded-md shadow-[0_8px_30px_rgb(0,0,0,0.04)]">
        @error('code')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4 col-span-2">
        <label for="name" class="block text-sm font-medium text-gray-700">Nama Aset</label>
        <input type="text" name="name" id="name" value="{{ old('name', $asset->name ?? '') }}"
               class="mt-1 block w-full border-gray-300 rounded-md shadow-[0_8px_30px_rgb(0,0,0,0.04)]">
        @error('name')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="asset_category_id" class="block text-sm font-medium text-gray-700">Kategori</label>
        <select name="asset_category_id" id="asset_category_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-[0_8px_30px_rgb(0,0,0,0.04)]">
            <option value="">-- Pilih Kategori --</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" @selected(old('asset_category_id', $asset->asset_category_id ?? '') == $category->id)>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        @error('asset_category_id')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="brand_id" class="block text-sm font-medium text-gray-700">Merek (opsional)</label>
        <select name="brand_id" id="brand_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-[0_8px_30px_rgb(0,0,0,0.04)]">
            <option value="">-- Pilih Merek --</option>
            @foreach ($brands as $brand)
                <option value="{{ $brand->id }}" @selected(old('brand_id', $asset->brand_id ?? '') == $brand->id)>
                    {{ $brand->name }}
                </option>
            @endforeach
        </select>
        @error('brand_id')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="model" class="block text-sm font-medium text-gray-700">Model (opsional)</label>
        <input type="text" name="model" id="model" value="{{ old('model', $asset->model ?? '') }}"
               class="mt-1 block w-full border-gray-300 rounded-md shadow-[0_8px_30px_rgb(0,0,0,0.04)]">
        @error('model')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="serial_number" class="block text-sm font-medium text-gray-700">Nomor Seri (opsional)</label>
        <input type="text" name="serial_number" id="serial_number" value="{{ old('serial_number', $asset->serial_number ?? '') }}"
               class="mt-1 block w-full border-gray-300 rounded-md shadow-[0_8px_30px_rgb(0,0,0,0.04)]">
        @error('serial_number')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="purchase_date" class="block text-sm font-medium text-gray-700">Tanggal Pembelian (opsional)</label>
        <input type="date" name="purchase_date" id="purchase_date"
               value="{{ old('purchase_date', isset($asset->purchase_date) ? $asset->purchase_date->format('Y-m-d') : '') }}"
               class="mt-1 block w-full border-gray-300 rounded-md shadow-[0_8px_30px_rgb(0,0,0,0.04)]">
        @error('purchase_date')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="warranty_end" class="block text-sm font-medium text-gray-700">Garansi Hingga (opsional)</label>
        <input type="date" name="warranty_end" id="warranty_end"
               value="{{ old('warranty_end', isset($asset->warranty_end) ? $asset->warranty_end->format('Y-m-d') : '') }}"
               class="mt-1 block w-full border-gray-300 rounded-md shadow-[0_8px_30px_rgb(0,0,0,0.04)]">
        @error('warranty_end')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="location_id" class="block text-sm font-medium text-gray-700">Lokasi</label>
        <select name="location_id" id="location_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-[0_8px_30px_rgb(0,0,0,0.04)]">
            <option value="">-- Pilih Lokasi --</option>
            @foreach ($locations as $location)
                <option value="{{ $location->id }}" @selected(old('location_id', $asset->location_id ?? '') == $location->id)>
                    {{ $location->name }}
                </option>
            @endforeach
        </select>
        @error('location_id')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
        <select name="status" id="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-[0_8px_30px_rgb(0,0,0,0.04)]">
            @foreach ($statuses as $value => $label)
                <option value="{{ $value }}" @selected(old('status', $asset->status ?? 'active') == $value)>
                    {{ $label }}
                </option>
            @endforeach
        </select>
        @error('status')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4 col-span-2">
        <label for="current_user_id" class="block text-sm font-medium text-gray-700">Pengguna Saat Ini (opsional)</label>
        <select name="current_user_id" id="current_user_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-[0_8px_30px_rgb(0,0,0,0.04)]">
            <option value="">-- Tidak Ada --</option>
            @foreach ($users as $user)
                <option value="{{ $user->id }}" @selected(old('current_user_id', $asset->current_user_id ?? '') == $user->id)>
                    {{ $user->name }}
                </option>
            @endforeach
        </select>
        @error('current_user_id')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>
</div>
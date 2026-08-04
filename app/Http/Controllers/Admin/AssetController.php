<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\AssetCategory;
use App\Models\Brand;
use App\Models\Location;
use App\Models\User;
use App\Models\WorkUnit;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AssetController extends Controller
{
    public const STATUSES = [
        'active' => 'Aktif Digunakan',
        'in_storage' => 'Di Gudang',
        'maintenance' => 'Dalam Perbaikan',
        'damaged' => 'Rusak',
        'disposed' => 'Dihapuskan',
    ];

    public function index(): View
    {
        $assets = Asset::with(['category', 'brand', 'location'])
            ->orderBy('name')
            ->paginate(10);

        return view('admin.assets.index', [
            'assets' => $assets,
            'statuses' => self::STATUSES,
        ]);
    }

    public function create(): View
    {
        return view('admin.assets.create', $this->formOptions());
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateAsset($request);
        $validated = $this->handleAssignmentType($request, $validated);

        Asset::create($validated);

        return redirect()->route('admin.assets.index')->with('success', 'Aset berhasil ditambahkan.');
    }

    public function edit(Asset $asset): View
    {
        return view('admin.assets.edit', array_merge(
            ['asset' => $asset],
            $this->formOptions()
        ));
    }

    public function update(Request $request, Asset $asset): RedirectResponse
    {
        $validated = $this->validateAsset($request, $asset);
        $validated = $this->handleAssignmentType($request, $validated);

        $asset->update($validated);

        return redirect()->route('admin.assets.index')->with('success', 'Aset berhasil diperbarui.');
    }

    public function destroy(Asset $asset): RedirectResponse
    {
        $asset->delete(); // Soft delete because of the trait

        return redirect()->route('admin.assets.index')->with('success', 'Aset berhasil dihapus (soft delete).');
    }

    private function validateAsset(Request $request, ?Asset $asset = null): array
    {
        $codeRule = 'unique:assets,code' . ($asset ? ',' . $asset->id : '');

        return $request->validate([
            'code' => ['required', 'string', 'max:255', $codeRule],
            'name' => ['required', 'string', 'max:255'],
            'asset_category_id' => ['required', 'exists:asset_categories,id'],
            'brand_id' => ['required', 'exists:brands,id'],
            'model' => ['nullable', 'string', 'max:255'],
            'serial_number' => ['nullable', 'string', 'max:255'],
            'purchase_date' => ['nullable', 'date'],
            'warranty_end' => ['nullable', 'date', 'after_or_equal:purchase_date'],
            'location_id' => ['required', 'exists:locations,id'],
            'status' => ['required', 'in:' . implode(',', array_keys(self::STATUSES))],
            'assignment_type' => ['required', 'in:user,work_unit'],
            'current_user_id' => ['nullable', 'exists:users,id'],
            'work_unit_id' => ['nullable', 'exists:work_units,id'],
            'notes' => ['nullable', 'string'],
        ]);
    }

    private function handleAssignmentType(Request $request, array $validated): array
    {
        if ($request->assignment_type === 'user') {
            $validated['work_unit_id'] = null;
        } else {
            $validated['current_user_id'] = null;
        }
        unset($validated['assignment_type']);
        return $validated;
    }

    private function formOptions(): array
    {
        return [
            'categories' => AssetCategory::where('is_active', true)->orderBy('name')->get(),
            'brands' => Brand::where('is_active', true)->orderBy('name')->get(),
            'locations' => Location::where('is_active', true)->orderBy('name')->get(),
            'users' => User::orderBy('name')->get(),
            'workUnits' => WorkUnit::with('department.compartment')->where('is_active', true)->get(),
            'statuses' => self::STATUSES,
        ];
    }
}
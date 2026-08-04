<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\AssetCategory;
use App\Models\Brand;
use App\Models\Location;
use App\Models\WorkUnit;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Response;

class WorkUnitAssetController extends Controller
{
    public const STATUSES = [
        'active' => 'Aktif Digunakan',
        'in_storage' => 'Di Gudang',
        'maintenance' => 'Dalam Perbaikan',
        'damaged' => 'Rusak',
        'disposed' => 'Dihapuskan',
    ];

    public function index(Request $request): View
    {
        $query = Asset::with(['workUnit.department.compartment', 'location'])
            ->whereNotNull('work_unit_id');

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('code', 'like', "%{$search}%")
                  ->orWhere('name', 'like', "%{$search}%")
                  ->orWhere('notes', 'like', "%{$search}%")
                  ->orWhereHas('workUnit', function ($q) use ($search) {
                      $q->where('name', 'like', "%{$search}%");
                  });
            });
        }

        $assets = $query->orderBy('created_at', 'desc')->paginate(15)->withQueryString();

        return view('admin.work-unit-assets.index', compact('assets'));
    }

    public function create(): View
    {
        return view('admin.work-unit-assets.create', $this->formOptions());
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateAsset($request);
        $validated['current_user_id'] = null;

        Asset::create($validated);

        return redirect()->route('admin.work-unit-assets.index')->with('success', 'Aset Unit Kerja berhasil ditambahkan.');
    }

    public function edit(Asset $workUnitAsset): View
    {
        return view('admin.work-unit-assets.edit', array_merge(
            ['asset' => $workUnitAsset],
            $this->formOptions()
        ));
    }

    public function update(Request $request, Asset $workUnitAsset): RedirectResponse
    {
        $validated = $this->validateAsset($request, $workUnitAsset);
        $validated['current_user_id'] = null;

        $workUnitAsset->update($validated);

        return redirect()->route('admin.work-unit-assets.index')->with('success', 'Aset Unit Kerja berhasil diperbarui.');
    }

    public function destroy(Asset $workUnitAsset): RedirectResponse
    {
        $workUnitAsset->delete();
        return redirect()->route('admin.work-unit-assets.index')->with('success', 'Aset Unit Kerja berhasil dihapus.');
    }

    private function validateAsset(Request $request, ?Asset $asset = null): array
    {
        $codeRule = 'unique:assets,code' . ($asset ? ',' . $asset->id : '');

        return $request->validate([
            'code' => ['required', 'string', 'max:255', $codeRule],
            'name' => ['required', 'string', 'max:255'],
            'asset_category_id' => ['required', 'exists:asset_categories,id'],
            'brand_id' => ['nullable', 'exists:brands,id'],
            'model' => ['nullable', 'string', 'max:255'],
            'serial_number' => ['nullable', 'string', 'max:255'],
            'purchase_date' => ['nullable', 'date'],
            'warranty_end' => ['nullable', 'date', 'after_or_equal:purchase_date'],
            'location_id' => ['required', 'exists:locations,id'],
            'status' => ['required', 'in:' . implode(',', array_keys(self::STATUSES))],
            'work_unit_id' => ['required', 'exists:work_units,id'],
            'notes' => ['nullable', 'string'],
        ]);
    }

    private function formOptions(): array
    {
        return [
            'categories' => AssetCategory::where('is_active', true)->orderBy('name')->get(),
            'brands' => Brand::where('is_active', true)->orderBy('name')->get(),
            'locations' => Location::where('is_active', true)->orderBy('name')->get(),
            'workUnits' => WorkUnit::with('department.compartment')->where('is_active', true)->orderBy('name')->get(),
            'statuses' => self::STATUSES,
        ];
    }

    public function exportCsv()
    {
        $assets = Asset::with(['workUnit.department.compartment', 'location'])
            ->whereNotNull('work_unit_id')
            ->orderBy('created_at', 'desc')
            ->get();

        return $this->generateCsv($assets, "monitoring_aset_unit_kerja_" . date('Y-m-d_H-i') . ".csv");
    }

    public function exportSingle(Asset $workUnitAsset)
    {
        $workUnitAsset->load(['workUnit.department.compartment', 'location']);
        return $this->generateCsv([$workUnitAsset], "aset_" . $workUnitAsset->code . "_" . date('Y-m-d_H-i') . ".csv");
    }

    private function generateCsv($assets, $filename)
    {
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$filename",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = [
            'Kode Aset',
            'Nama Aset',
            'Unit Kerja',
            'Lokasi',
            'Status',
            'Keterangan'
        ];

        $callback = function() use($assets, $columns) {
            $file = fopen('php://output', 'w');
            fputs($file, "\xEF\xBB\xBF"); // BOM for excel
            fputcsv($file, $columns, ';');
            fclose($file);
            
            $file = fopen('php://output', 'a');
            foreach ($assets as $asset) {
                $workUnitName = $asset->workUnit ? $asset->workUnit->name . ' (' . ($asset->workUnit->department->name ?? '-') . ')' : '-';
                
                $row = [
                    $asset->code,
                    $asset->name,
                    $workUnitName,
                    $asset->location->name ?? '-',
                    $asset->status,
                    $asset->notes ?? '-'
                ];

                fputcsv($file, $row, ';');
            }
            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }
}

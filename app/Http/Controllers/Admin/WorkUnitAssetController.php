<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Response;

class WorkUnitAssetController extends Controller
{
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

    public function exportCsv()
    {
        $assets = Asset::with(['workUnit.department.compartment', 'location'])
            ->whereNotNull('work_unit_id')
            ->orderBy('created_at', 'desc')
            ->get();

        $filename = "monitoring_aset_unit_kerja_" . date('Y-m-d_H-i') . ".csv";

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
            
            // Add BOM for UTF-8 Excel compatibility
            fputs($file, "\xEF\xBB\xBF");
            
            fputcsv($file, $columns, ';'); // Use semicolon for Excel compatibility in some regions, or comma. Using semicolon is often safer for Indonesian Excel. Wait, let's use comma and BOM.
            // Actually, comma is standard CSV. Let's stick to comma for standard.
            
            // Close and reopen to write standard csv
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

                fputcsv($file, $row);
            }

            fclose($file);
        };

        return Response::stream($callback, 200, $headers);
    }
}

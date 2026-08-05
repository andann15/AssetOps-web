<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\WorkUnitAssetStatus;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class WorkUnitAssetStatusController extends Controller
{
    public function index(): View
    {
        $statuses = WorkUnitAssetStatus::orderBy('order')->orderBy('name')->get();
        return view('admin.work-unit-asset-statuses.index', compact('statuses'));
    }

    public function create(): View
    {
        return view('admin.work-unit-asset-statuses.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:100'],
        ]);

        WorkUnitAssetStatus::create([
            'name'      => $validated['name'],
            'slug'      => Str::slug($validated['name'], '_'),
            'is_active' => true,
            'order'     => WorkUnitAssetStatus::max('order') + 1,
        ]);

        return redirect()->route('admin.work-unit-asset-statuses.index')
            ->with('success', 'Status berhasil ditambahkan.');
    }

    public function edit(WorkUnitAssetStatus $workUnitAssetStatus): View
    {
        return view('admin.work-unit-asset-statuses.edit', compact('workUnitAssetStatus'));
    }

    public function update(Request $request, WorkUnitAssetStatus $workUnitAssetStatus): RedirectResponse
    {
        $validated = $request->validate([
            'name'  => ['required', 'string', 'max:100'],
            'order' => ['nullable', 'integer', 'min:0'],
        ]);

        $workUnitAssetStatus->update([
            'name'  => $validated['name'],
            'order' => $validated['order'] ?? $workUnitAssetStatus->order,
        ]);

        return redirect()->route('admin.work-unit-asset-statuses.index')
            ->with('success', 'Status berhasil diperbarui.');
    }

    public function destroy(WorkUnitAssetStatus $workUnitAssetStatus): RedirectResponse
    {
        $workUnitAssetStatus->delete();
        return redirect()->route('admin.work-unit-asset-statuses.index')
            ->with('success', 'Status berhasil dihapus.');
    }

    public function toggle(WorkUnitAssetStatus $workUnitAssetStatus): RedirectResponse
    {
        $workUnitAssetStatus->update(['is_active' => !$workUnitAssetStatus->is_active]);
        return redirect()->route('admin.work-unit-asset-statuses.index')
            ->with('success', 'Status berhasil ' . ($workUnitAssetStatus->is_active ? 'dinonaktifkan' : 'diaktifkan') . '.');
    }
}

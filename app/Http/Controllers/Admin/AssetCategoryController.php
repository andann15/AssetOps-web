<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AssetCategory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AssetCategoryController extends Controller
{
    public function index(): View
    {
        $assetCategories = AssetCategory::orderBy('name')->paginate(10);

        return view('admin.asset-categories.index', compact('assetCategories'));
    }

    public function create(): View
    {
        return view('admin.asset-categories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:asset_categories,name'],
        ]);

        AssetCategory::create(['name' => $validated['name'], 'is_active' => true]);

        return redirect()->route('admin.asset-categories.index')->with('success', 'Kategori aset berhasil ditambahkan.');
    }

    public function edit(AssetCategory $assetCategory): View
    {
        return view('admin.asset-categories.edit', compact('assetCategory'));
    }

    public function update(Request $request, AssetCategory $assetCategory): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:asset_categories,name,' . $assetCategory->id],
        ]);

        $assetCategory->update(['name' => $validated['name']]);

        return redirect()->route('admin.asset-categories.index')->with('success', 'Kategori aset berhasil diperbarui.');
    }

    public function toggleActive(AssetCategory $assetCategory): RedirectResponse
    {
        $assetCategory->update(['is_active' => ! $assetCategory->is_active]);

        return redirect()->route('admin.asset-categories.index')->with('success', 'Status kategori aset berhasil diubah.');
    }
}
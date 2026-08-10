<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class BrandController extends Controller
{
    public function index(Request $request): View
    {
        $query = Brand::orderBy('name');
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        $brands = $query->paginate(10)->withQueryString();

        return view('admin.brands.index', compact('brands'));
    }

    public function create(): View
    {
        return view('admin.brands.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:brands,name'],
        ]);

        Brand::create(['name' => $validated['name'], 'is_active' => true]);

        return redirect()->route('admin.brands.index')->with('success', 'Merek berhasil ditambahkan.');
    }

    public function edit(Brand $brand): View
    {
        return view('admin.brands.edit', compact('brand'));
    }

    public function update(Request $request, Brand $brand): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:brands,name,' . $brand->id],
        ]);

        $brand->update(['name' => $validated['name']]);

        return redirect()->route('admin.brands.index')->with('success', 'Merek berhasil diperbarui.');
    }

    public function toggleActive(Brand $brand): RedirectResponse
    {
        $brand->update(['is_active' => ! $brand->is_active]);

        return redirect()->route('admin.brands.index')->with('success', 'Status merek berhasil diubah.');
    }
}
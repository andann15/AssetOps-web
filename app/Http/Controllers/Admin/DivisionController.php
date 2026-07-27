<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Division;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DivisionController extends Controller
{
    public function index(): View
    {
        $divisions = Division::orderBy('name')->paginate(10);

        return view('admin.divisions.index', compact('divisions'));
    }

    public function create(): View
    {
        return view('admin.divisions.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:divisions,name'],
        ]);

        Division::create([
            'name' => $validated['name'],
            'is_active' => true,
        ]);

        return redirect()->route('admin.divisions.index')->with('success', 'Divisi berhasil ditambahkan.');
    }

    public function edit(Division $division): View
    {
        return view('admin.divisions.edit', compact('division'));
    }

    public function update(Request $request, Division $division): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255', 'unique:divisions,name,' . $division->id],
        ]);

        $division->update(['name' => $validated['name']]);

        return redirect()->route('admin.divisions.index')->with('success', 'Divisi berhasil diperbarui.');
    }

    public function toggleActive(Division $division): RedirectResponse
    {
        $division->update(['is_active' => ! $division->is_active]);

        return redirect()->route('admin.divisions.index')->with('success', 'Status divisi berhasil diubah.');
    }
}
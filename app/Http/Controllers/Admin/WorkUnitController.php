<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Compartment;
use App\Models\Department;
use App\Models\WorkUnit;
use Illuminate\Http\Request;

class WorkUnitController extends Controller
{
    public function index()
    {
        $workUnits = WorkUnit::with('department.compartment')
            ->orderBy('created_at', 'desc')
            ->paginate(15);
        return view('admin.work-units.index', compact('workUnits'));
    }

    public function create()
    {
        $compartments = Compartment::where('is_active', true)->get();
        $departments = Department::where('is_active', true)->with('compartment')->get();
        return view('admin.work-units.create', compact('compartments', 'departments'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'department_id' => ['required', 'exists:departments,id'],
            'name'          => ['required', 'string', 'max:255'],
        ]);

        WorkUnit::create([
            'department_id' => $validated['department_id'],
            'name'          => $validated['name'],
            'is_active'     => true,
        ]);

        return redirect()->route('admin.work-units.index')
            ->with('success', 'Unit Kerja berhasil ditambahkan.');
    }

    public function edit(WorkUnit $workUnit)
    {
        $compartments = Compartment::where('is_active', true)->get();
        $departments = Department::where('is_active', true)->with('compartment')->get();
        return view('admin.work-units.edit', compact('workUnit', 'compartments', 'departments'));
    }

    public function update(Request $request, WorkUnit $workUnit)
    {
        $validated = $request->validate([
            'department_id' => ['required', 'exists:departments,id'],
            'name'          => ['required', 'string', 'max:255'],
        ]);

        $workUnit->update($validated);

        return redirect()->route('admin.work-units.index')
            ->with('success', 'Unit Kerja berhasil diperbarui.');
    }

    public function toggleActive(WorkUnit $workUnit)
    {
        $workUnit->update(['is_active' => !$workUnit->is_active]);
        return back()->with('success', 'Status Unit Kerja berhasil diubah.');
    }
}

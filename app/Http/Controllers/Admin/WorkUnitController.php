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
            'new_compartment_name' => ['nullable', 'string', 'max:255'],
            'compartment_id'       => ['nullable', 'exists:compartments,id'],
            'new_department_name'  => ['nullable', 'string', 'max:255'],
            'department_id'        => ['nullable', 'exists:departments,id'],
            'name'                 => ['nullable', 'string', 'max:255'],
        ]);

        $compartmentId = $request->compartment_id;
        $compartmentName = null;
        if ($request->filled('new_compartment_name')) {
            $comp = Compartment::create(['name' => $request->new_compartment_name, 'is_active' => true]);
            $compartmentId = $comp->id;
            $compartmentName = $comp->name;
        } elseif ($compartmentId) {
            $compartmentName = Compartment::find($compartmentId)->name;
        }

        $departmentId = $request->department_id;
        $departmentName = null;
        if ($request->filled('new_department_name')) {
            $dept = Department::create(['compartment_id' => $compartmentId, 'name' => $request->new_department_name, 'is_active' => true]);
            $departmentId = $dept->id;
            $departmentName = $dept->name;
        } elseif ($departmentId) {
            $departmentName = Department::find($departmentId)->name;
        }

        $workUnitName = $validated['name'] ?? null;
        if (empty($workUnitName)) {
            if ($departmentName) {
                $workUnitName = $departmentName;
            } elseif ($compartmentName) {
                $workUnitName = $compartmentName;
            } else {
                return back()->withErrors(['name' => 'Minimal salah satu (Kompartemen, Departemen, atau Unit Kerja) harus diisi.'])->withInput();
            }
        }

        WorkUnit::create([
            'department_id' => $departmentId,
            'name'          => $workUnitName,
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
            'new_compartment_name' => ['nullable', 'string', 'max:255'],
            'compartment_id'       => ['nullable', 'exists:compartments,id'],
            'new_department_name'  => ['nullable', 'string', 'max:255'],
            'department_id'        => ['nullable', 'exists:departments,id'],
            'name'                 => ['nullable', 'string', 'max:255'],
        ]);

        $compartmentId = $request->compartment_id;
        $compartmentName = null;
        if ($request->filled('new_compartment_name')) {
            $comp = Compartment::create(['name' => $request->new_compartment_name, 'is_active' => true]);
            $compartmentId = $comp->id;
            $compartmentName = $comp->name;
        } elseif ($compartmentId) {
            $compartmentName = Compartment::find($compartmentId)->name;
        }

        $departmentId = $request->department_id;
        $departmentName = null;
        if ($request->filled('new_department_name')) {
            $dept = Department::create(['compartment_id' => $compartmentId, 'name' => $request->new_department_name, 'is_active' => true]);
            $departmentId = $dept->id;
            $departmentName = $dept->name;
        } elseif ($departmentId) {
            $departmentName = Department::find($departmentId)->name;
        }

        $workUnitName = $validated['name'] ?? null;
        if (empty($workUnitName)) {
            if ($departmentName) {
                $workUnitName = $departmentName;
            } elseif ($compartmentName) {
                $workUnitName = $compartmentName;
            } else {
                return back()->withErrors(['name' => 'Minimal salah satu (Kompartemen, Departemen, atau Unit Kerja) harus diisi.'])->withInput();
            }
        }

        $workUnit->update([
            'department_id' => $departmentId,
            'name'          => $workUnitName,
        ]);

        return redirect()->route('admin.work-units.index')
            ->with('success', 'Unit Kerja berhasil diperbarui.');
    }

    public function toggleActive(WorkUnit $workUnit)
    {
        $workUnit->update(['is_active' => !$workUnit->is_active]);
        return back()->with('success', 'Status Unit Kerja berhasil diubah.');
    }
}

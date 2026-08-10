<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RejectionReason;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RejectionReasonController extends Controller
{
    public function index(Request $request): View
    {
        $query = RejectionReason::orderBy('label');
        if ($request->filled('search')) {
            $query->where('label', 'like', '%' . $request->search . '%');
        }
        $rejectionReasons = $query->paginate(10)->withQueryString();

        return view('admin.rejection-reasons.index', compact('rejectionReasons'));
    }

    public function create(): View
    {
        return view('admin.rejection-reasons.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'label' => ['required', 'string', 'max:255', 'unique:rejection_reasons,label'],
        ]);

        RejectionReason::create(['label' => $validated['label'], 'is_active' => true]);

        return redirect()->route('admin.rejection-reasons.index')->with('success', 'Alasan penolakan berhasil ditambahkan.');
    }

    public function edit(RejectionReason $rejectionReason): View
    {
        return view('admin.rejection-reasons.edit', compact('rejectionReason'));
    }

    public function update(Request $request, RejectionReason $rejectionReason): RedirectResponse
    {
        $validated = $request->validate([
            'label' => ['required', 'string', 'max:255', 'unique:rejection_reasons,label,' . $rejectionReason->id],
        ]);

        $rejectionReason->update(['label' => $validated['label']]);

        return redirect()->route('admin.rejection-reasons.index')->with('success', 'Alasan penolakan berhasil diperbarui.');
    }

    public function toggleActive(RejectionReason $rejectionReason): RedirectResponse
    {
        $rejectionReason->update(['is_active' => ! $rejectionReason->is_active]);

        return redirect()->route('admin.rejection-reasons.index')->with('success', 'Status alasan penolakan berhasil diubah.');
    }
}
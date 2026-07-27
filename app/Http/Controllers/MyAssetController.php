<?php

namespace App\Http\Controllers;

use App\Models\Asset;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;

class MyAssetController extends Controller
{
    public function index(Request $request): RedirectResponse
    {
        return redirect()->route('dashboard');
    }

    public function claim(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'asset_id' => ['required', 'exists:assets,id'],
        ]);

        $asset = Asset::findOrFail($validated['asset_id']);
        
        // Ensure the asset is currently not assigned
        if ($asset->current_user_id !== null) {
            return back()->with('error', 'Aset ini sudah digunakan oleh orang lain.');
        }

        $asset->update(['current_user_id' => $request->user()->id]);

        return back()->with('success', 'Aset berhasil ditambahkan ke daftar Anda.');
    }
}

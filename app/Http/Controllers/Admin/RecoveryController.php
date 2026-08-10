<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Asset;
use App\Models\Ticket;
use Illuminate\View\View;

class RecoveryController extends Controller
{
    public function index(): View
    {
        $individualAssets = Asset::onlyTrashed()
            ->with(['category', 'brand', 'location'])
            ->whereNull('work_unit_id')
            ->orderBy('deleted_at', 'desc')
            ->get();

        $workUnitAssets = Asset::onlyTrashed()
            ->with(['workUnit.department.compartment', 'location'])
            ->whereNotNull('work_unit_id')
            ->orderBy('deleted_at', 'desc')
            ->get();

        $tickets = Ticket::onlyTrashed()
            ->with(['asset', 'creator'])
            ->orderBy('deleted_at', 'desc')
            ->get();

        return view('admin.recovery.index', compact('individualAssets', 'workUnitAssets', 'tickets'));
    }
}

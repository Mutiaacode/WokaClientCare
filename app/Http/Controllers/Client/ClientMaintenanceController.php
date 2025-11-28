<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Maintenance;
use App\Models\MaintenanceSchedule;

class ClientMaintenanceController extends Controller
{
    public function index()
    {
        $clientId = Auth::user()->client->id;

        // Ambil maintenance berdasarkan contract milik client
        $maintenances = MaintenanceSchedule::whereHas('contract', function ($q) use ($clientId) {
                $q->where('client_id', $clientId);
            })
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('client.maintenance.index', compact('maintenances'));
    }
}

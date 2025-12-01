<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\MaintenanceSchedule;
use Illuminate\Support\Facades\Auth;

class ClientMaintenanceController extends Controller
{
    public function index()
    {
        $clientId = Auth::user()->client->id;

        $maintenances = MaintenanceSchedule::whereHas('contract', function ($q) use ($clientId) {
            $q->where('client_id', $clientId);
        })->orderBy('tanggal_kunjungan', 'ASC')->get();

        return view('client.maintenance.index', compact('maintenances'));
    }

   public function accept($id)
{
    $m = MaintenanceSchedule::findOrFail($id);

    // status tetap dijadwalkan
    $m->status = 'terima';
    $m->save();

    // kasih flag bahwa client sudah aksi
    session(['maintenance_action_'.$id => true]);

    return back()->with('success', 'Maintenance telah diterima!');
}

public function reject($id)
{
    $m = MaintenanceSchedule::findOrFail($id);

    $m->status = 'dibatalkan';
    $m->save();

    // kasih flag bahwa client sudah aksi
    session(['maintenance_action_'.$id => true]);

    return back()->with('success', 'Maintenance telah ditolak!');
}

}

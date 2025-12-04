<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\MaintenanceSchedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientMaintenanceController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->search;
        $client = Auth::user()->client;

        $maintenances = MaintenanceSchedule::with(['contract', 'teknisi'])
            ->whereHas('contract', function ($q) use ($client) {
                $q->where('client_id', $client->id);
            })
            ->where(function ($query) use ($keyword) {
                $query->where('status', 'LIKE', "%{$keyword}%")

                    ->orWhereHas('contract', function ($q) use ($keyword) {
                        $q->where('nomor_kontrak', 'LIKE', "%{$keyword}%");
                    })
                    ->orWhereHas('teknisi', function ($q) use ($keyword) {
                        $q->where('name', 'LIKE', "%{$keyword}%");
                    });
            })
            ->get();
        return view('client.maintenance.index', compact('maintenances'));
    }

    public function accept($id)
    {
        $m = MaintenanceSchedule::findOrFail($id);

        // status tetap dijadwalkan
        $m->status = 'terima';
        $m->save();

        // kasih flag bahwa client sudah aksi
        session(['maintenance_action_' . $id => true]);

        return back()->with('success', 'Maintenance telah diterima!');
    }

    public function reject($id)
    {
        $m = MaintenanceSchedule::findOrFail($id);

        $m->status = 'dibatalkan';
        $m->save();

        // kasih flag bahwa client sudah aksi
        session(['maintenance_action_' . $id => true]);

        return back()->with('success', 'Maintenance telah ditolak!');
    }

}

<?php

namespace App\Http\Controllers\Teknisi;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\MaintenanceSchedule;
use Illuminate\Http\Request;

class TeknisiMaintenanceController extends Controller
{
    public function index()
    {
        $maintenance = MaintenanceSchedule::all();
        return view('teknisi.maintenance.index', compact('maintenance'));
    }

    public function show ($id)
    {
        $maintenance = MaintenanceSchedule::with(['contract', 'teknisi'])
        ->findOrFail($id);

        return view (' teknisi.maintenance.show', compact('maintenance'));
    }

     public function update(Request $request, $id)
    {
        $request->validate([
            'catatan' => 'nullable|string'
        ]);

        $maintenance = MaintenanceSchedule::findOrFail($id);
        $maintenance->catatan = $request->catatan;
        $maintenance->save();

        return back()->with('sukses', 'Catatan berhasil diperbarui!');
    }
}

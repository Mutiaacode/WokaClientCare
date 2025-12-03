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

    public function show($id)
    {
        $maintenance = MaintenanceSchedule::with(['contract', 'teknisi'])
            ->findOrFail($id);

        return view(' teknisi.maintenance.show', compact('maintenance'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'catatan' => 'nullable|string',
            'status' => 'string'
        ]);

        $maintenance = MaintenanceSchedule::findOrFail($id);
        $maintenance->catatan = $request->catatan;
        $maintenance->status = $request->status;
        $maintenance->save();

        return redirect()->route('teknisi.maintenance.index')->with('sukses', 'Catatan berhasil diperbarui!');
    }

    public function search(Request $request)
    {
        $query = MaintenanceSchedule::with(['contract.client.user'])
            ->where('teknisi_id', auth()->id()); // <--- FILTER WAJIB

        if ($request->nama) {
            $query->whereHas('contract.client.user', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->nama . '%');
            });
        }

        $maintenance = $query->get();

        return view('teknisi.maintenance.index', compact('maintenance'));
    }

}

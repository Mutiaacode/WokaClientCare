<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\MaintenanceSchedule;
use App\Models\Contract;
use App\Models\User;
use Illuminate\Http\Request;

class AdminMaintenanceController extends Controller
{
    public function index()
    {
        $maintenances = MaintenanceSchedule::with(['contract.client.user', 'teknisi'])
            ->latest()
            ->get();

        return view('admin.maintenance.index', compact('maintenances'));
    }

    public function create()
    {
        $contracts = Contract::with(['client.user'])->get();
        $teknisi = User::where('role', 'teknisi')->get();

        return view('admin.maintenance.create', compact('contracts', 'teknisi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'contract_id' => 'required|exists:contracts,id',
            'teknisi_id' => 'required|exists:users,id',
            'tanggal_kunjungan' => 'required|date',
            'jam_kunjungan' => 'required',
            'catatan' => 'nullable|string',
        ]);

        MaintenanceSchedule::create([
            'contract_id' => $request->contract_id,
            'teknisi_id' => $request->teknisi_id,
            'tanggal_kunjungan' => $request->tanggal_kunjungan,
            'jam_kunjungan' => $request->jam_kunjungan,
            'catatan' => $request->catatan,
            'status' => 'dijadwalkan',
        ]);

        return redirect()->route('admin.maintenance.index')
            ->with('sukses', 'Maintenance berhasil dijadwalkan.');
    }

    public function show($id)
    {
        $maintenance = MaintenanceSchedule::with(['contract.client.user', 'teknisi'])->findOrFail($id);

        return view('admin.maintenance.show', compact('maintenance'));
    }

    public function edit($id)
    {
        $maintenance = MaintenanceSchedule::findOrFail($id);
        $contracts = Contract::with('client.user')->get();
        $teknisi = User::where('role', 'teknisi')->get();

        return view('admin.maintenance.edit', compact('maintenance', 'contracts', 'teknisi'));
    }

    public function update(Request $request, $id)
    {
        $maintenance = MaintenanceSchedule::findOrFail($id);

        $request->validate([
            'teknisi_id'        => 'required|exists:users,id',
            'tanggal_kunjungan' => 'required|date',
            'jam_kunjungan'     => 'required',
            'catatan'           => 'nullable|string',
            'status'            => 'required|in:dijadwalkan,selesai,dibatalkan',
        ]);

        $maintenance->update([
            'teknisi_id'        => $request->teknisi_id,
            'tanggal_kunjungan' => $request->tanggal_kunjungan,
            'jam_kunjungan'     => $request->jam_kunjungan,
            'catatan'           => $request->catatan,
            'status'            => $request->status,
        ]);

        return redirect()->route('admin.maintenance.index')
            ->with('sukses', 'Maintenance berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $maintenance = MaintenanceSchedule::findOrFail($id);
        $maintenance->delete();

        return redirect()->route('admin.maintenance.index')->with('sukses', 'Maintenance berhasil dihapus.');
    }
}

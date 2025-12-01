<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Contract;
use App\Models\Ticket;
use App\Models\Invoice;
use App\Models\MaintenanceSchedule;

class ClientDashboardController extends Controller
{
    public function index()
    {
        $clientId = Auth::user()->client->id;

        // CARD DATA
        $contractAktif = Contract::where('client_id', $clientId)
            ->where('status', 'aktif')
            ->count();

        $ticketAktif = Ticket::where('client_id', $clientId)
            ->whereIn('status', ['open', 'in_progress'])
            ->count();

        $invoiceBelumBayar = Invoice::whereHas('contract', function ($q) use ($clientId) {
                $q->where('client_id', $clientId);
            })
            ->where('status', 'unpaid')
            ->count();

        // Tiket terbaru
        $tiketTerbaru = Ticket::where('client_id', $clientId)
            ->orderBy('created_at', 'DESC')
            ->take(5)
            ->get();

        // Maintenance berdasarkan kontrak client
        $maintenances = MaintenanceSchedule::whereHas('contract', function ($q) use ($clientId) {
                $q->where('client_id', $clientId);
            })
            ->orderBy('tanggal_kunjungan', 'ASC')
            ->take(5)
            ->get();

        return view('client.dashboard', compact(
            'contractAktif',
            'ticketAktif',
            'invoiceBelumBayar',
            'tiketTerbaru',
            'maintenances'
        ));
    }
}

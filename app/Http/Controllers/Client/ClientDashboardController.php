<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Contract;
use App\Models\Ticket;
use App\Models\Invoice;
use App\Models\Maintenance;

class ClientDashboardController extends Controller
{
    public function index()
    {
        $clientId = Auth::user()->client->id;

        // Hitung data untuk card
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

        // Maintenance terdekat (opsional, kalau tabelnya ada)
        //$maintenanceTerdekat = Maintenance::where('client_id', $clientId)
            //->orderBy('tanggal', 'ASC')
            //->take(5)
            //->get();

        return view('client.dashboard', compact(
            'contractAktif',
            'ticketAktif',
            'invoiceBelumBayar',
            'tiketTerbaru',
            //'maintenanceTerdekat'
        ));
    }
}

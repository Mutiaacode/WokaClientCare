<?php

namespace App\Http\Controllers\Teknisi;

use App\Http\Controllers\Controller;
use App\Models\MaintenanceSchedule;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeknisiDashboardController extends Controller
{
    public function index()
    {
        $totalTickets = Ticket::count();
        $totalMaintenances = MaintenanceSchedule::count();
        return view('teknisi.dashboard', compact('totalTickets', 'totalMaintenances'));
    }
}

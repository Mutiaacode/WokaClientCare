<?php

namespace App\Http\Controllers\Teknisi;

use App\Http\Controllers\Controller;
use App\Models\MaintenanceSchedule;
use Illuminate\Http\Request;

class TeknisiMaintenanceController extends Controller
{
    public function index()
    {
        $maintenance = MaintenanceSchedule::where('teknisi_id', auth()->id())->get();
        return view('teknisi.maintenance.index', compact('maintenance'));
    }
}

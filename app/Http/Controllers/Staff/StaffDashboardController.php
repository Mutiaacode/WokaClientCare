<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\Invoice;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StaffDashboardController extends Controller
{
    public function index()
    {
        $staff = Auth::user();
        $contracts = Contract::where('staff_id', $staff->id)->pluck('id');
        $totalTickets = Ticket::whereIn('staff_id', $staff)->count();
        $totalInvoices = Invoice::whereIn('contract_id', $contracts)->count();

        return view('staff.dashboard', compact('totalTickets', 'totalInvoices'));
    }
}

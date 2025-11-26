<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Ticket;
use Illuminate\Http\Request;

class StaffDashboardController extends Controller
{
    public function index()
    {
        $totalTickets = Ticket::count();
        $totalInvoices = Invoice::count();
        return view('staff.dashboard',compact('totalTickets', 'totalInvoices'));
    }
}

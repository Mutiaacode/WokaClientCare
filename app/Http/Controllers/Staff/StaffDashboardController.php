<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use Illuminate\Http\Request;

class StaffDashboardController extends Controller
{
    public function index()
    {
        return view('staff.dashboard');
    }
}

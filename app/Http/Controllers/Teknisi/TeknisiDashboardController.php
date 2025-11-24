<?php

namespace App\Http\Controllers\Teknisi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TeknisiDashboardController extends Controller
{
    public function index()
    {
        return view('teknisi.dashboard');
    }
}

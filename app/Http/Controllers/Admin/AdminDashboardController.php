<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Client;
use App\Models\Product;
use App\Models\Contract;
use Carbon\Carbon;

class AdminDashboardController extends Controller
{
    public function index()
    {

        $totalUsers = User::count();
        $totalClients = Client::count();
        $totalProducts = Product::count();
        $totalContracts = Contract::count();
        $kontrakAktif = Contract::where('status', 'aktif')->count();
        $kontrakMenunggu = Contract::where('status', 'menunggu')->count();
        $kontrakExpired = Contract::where('status', 'kedaluwarsa')->count();

        $hampirExpired = Contract::where('status', 'aktif')
            ->whereBetween('tanggal_berakhir', [
                Carbon::now(),
                Carbon::now()->addDays(7)
            ])->get();

        $chartData = [];
        for ($i = 1; $i <= 12; $i++) {
            $chartData[] = Contract::whereMonth('created_at', $i)->count();
        }

        $staff = User::where('role', 'staff')->get();
        $teknisi = User::where('role', 'teknisi')->get();

        $accPending = Contract::where('status', 'menunggu')->latest()->take(5)->get();

        $recentActivities = Contract::latest()->take(5)->get();

        return view('admin.dashboard', compact(
            'totalUsers',
            'totalClients',
            'totalProducts',
            'totalContracts',
            'kontrakAktif',
            'kontrakMenunggu',
            'kontrakExpired',
            'hampirExpired',
            'chartData',
            'staff',
            'teknisi',
            'accPending',
            'recentActivities'
        ));
    }
}

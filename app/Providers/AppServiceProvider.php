<?php

namespace App\Providers;

use App\Models\Client;
use Illuminate\Support\Facades\View;
use App\Models\Contract;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        View::composer('*', function ($view) {

            // Jika belum login → kosongkan notif
            if (!Auth::check()) {
                return $view->with([
                    'notifCount'   => 0,
                    'notifPending' => collect(),
                    'notifHampir'  => collect(),
                    'notifExpired' => collect(),
                ]);
            }

            $user = Auth::user();
            $hidden = session()->get('hidden_notif', []);

            // ===== BASE QUERY KONTRAK =====
            $contracts = Contract::query()->whereNotIn('id', $hidden);

            // ===== FILTER KHUSUS CLIENT =====
            if ($user->role === 'client') {

                // Cek data client berdasarkan user_id
                $client = Client::where('user_id', $user->id)->first();

                if ($client) {
                    // Filter kontrak yang dimiliki client
                    $contracts->where('client_id', $client->id);
                } else {
                    // Jika user client tapi tidak punya client data → nol
                    return $view->with([
                        'notifCount'   => 0,
                        'notifPending' => collect(),
                        'notifHampir'  => collect(),
                        'notifExpired' => collect(),
                    ]);
                }
            }

            // ===== AMBIL NOTIFIKASI =====
            $pending = (clone $contracts)
                ->where('status', 'menunggu')
                ->get();

            $hampirExpired = (clone $contracts)
                ->where('status', 'aktif')
                ->whereBetween('tanggal_berakhir', [
                    Carbon::now(),
                    Carbon::now()->addDays(7)
                ])
                ->get();

            $expired = (clone $contracts)
                ->where('status', 'kedaluwarsa')
                ->get();

            $notifCount = $pending->count()
                + $hampirExpired->count()
                + $expired->count();

            // Kirim ke semua view
            $view->with([
                'notifCount'   => $notifCount,
                'notifPending' => $pending,
                'notifHampir'  => $hampirExpired,
                'notifExpired' => $expired
            ]);
        });
    }
}

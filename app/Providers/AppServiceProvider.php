<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use App\Models\Contract;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        View::composer('*', function ($view) {

            $hidden = session()->get('hidden_notif', []);

            $pending = Contract::where('status', 'menunggu')
                ->whereNotIn('id', $hidden)
                ->get();

            $hampirExpired = Contract::where('status', 'aktif')
                ->whereBetween('tanggal_berakhir', [
                    Carbon::now(),
                    Carbon::now()->addDays(7)
                ])
                ->whereNotIn('id', $hidden)
                ->get();

            $expired = Contract::where('status', 'kedaluwarsa')
                ->whereNotIn('id', $hidden)
                ->get();

            $notifCount = $pending->count()
                + $hampirExpired->count()
                + $expired->count();

            $view->with([
                'notifCount'   => $notifCount,
                'notifPending' => $pending,
                'notifHampir'  => $hampirExpired,
                'notifExpired' => $expired
            ]);
        });
    }
}

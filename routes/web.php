<?php

use App\Http\Controllers\Teknisi\TeknisiDashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminClientController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminContractController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/login', [AuthController::class, 'showLogin'])
    ->middleware('redirect.auth')
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->middleware('redirect.auth')
    ->name('login.process');

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

Route::middleware(['auth', 'role:admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [AdminDashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('clients', AdminClientController::class);
        Route::resource('product', AdminProductController::class);
        Route::resource('users', AdminUserController::class);
        Route::resource('contract', AdminContractController::class);
    });

Route::middleware(['auth', 'role:teknisi'])
    ->prefix('teknisi')
    ->name('teknisi.')
    ->group(function () {

        Route::get('/dashboard', [TeknisiDashboardController::class, 'index'])
            ->name('dashboard');
    });

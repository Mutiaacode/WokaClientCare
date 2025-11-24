<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminClientController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminContractController;
use App\Http\Controllers\Admin\AdminTicketController;


use App\Http\Controllers\Client\ClientContractController;
use App\Http\Controllers\Client\ClientDashboardController;
use App\Http\Controllers\Client\ClientTicketController;


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
        Route::resource('tickets', AdminTicketController::class);

    });

Route::middleware(['auth', 'role:client'])
    ->prefix('client')
    ->name('client.')
    ->group(function () {
        Route::get('/dashboard', [ClientDashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('contracts', ClientContractController::class);
        Route::get('/contract', [ClientContractController::class, 'index'])
            ->name('contract.index');
        Route::get('/contract/{id}', [ClientContractController::class, 'show'])
            ->name('contract.show');
        Route::post('/contract/{id}/approve', [ClientContractController::class, 'approve'])
            ->name('contract.approve');

        Route::resource('ticket', ClientTicketController::class);    
    });



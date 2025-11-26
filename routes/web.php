<?php

use App\Http\Controllers\Teknisi\TeknisiDashboardController;
use App\Http\Controllers\Teknisi\TeknisiMaintenanceController;
use App\Http\Controllers\Teknisi\TeknisiTicketController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminClientController;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\AdminContractController;
use App\Http\Controllers\Admin\AdminTicketController;
use App\Http\Controllers\Admin\AdminInvoiceController;



use App\Http\Controllers\Client\ClientContractController;
use App\Http\Controllers\Client\ClientDashboardController;
use App\Http\Controllers\Client\ClientInvoiceController;
use App\Http\Controllers\Client\ClientTicketController;
use App\Http\Controllers\Staff\StaffDashboardController;
use App\Http\Controllers\Staff\StaffTicketController;
use App\Http\Controllers\Staff\StaffTiketController;
use App\Http\Controllers\Staff\StaffInvoiceController;


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
        Route::resource('invoices', AdminInvoiceController::class);
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

        Route::get('/invoice', [ClientInvoiceController::class, 'index'])
            ->name('invoice.index');

        Route::get('/invoice/{id}', [ClientInvoiceController::class, 'show'])
            ->name('invoice.show');

        Route::post('/invoice/{id}/upload', [ClientInvoiceController::class, 'uploadPayment'])
            ->name('invoice.upload');

        Route::get('/invoice/{id}/pay', [ClientInvoiceController::class, 'pay'])
    ->name('invoice.pay'); // <-- halaman upload
    });

Route::middleware(['auth', 'role:teknisi'])
    ->prefix('teknisi')
    ->name('teknisi.')
    ->group(function () {

        Route::get('/dashboard', [TeknisiDashboardController::class, 'index'])
            ->name('dashboard');
        Route::resource('ticket', TeknisiTicketController::class);
        Route::resource('maintenance', TeknisiMaintenanceController::class);
    });


Route::middleware(['auth', 'role:staff'])
    ->prefix('staff')
    ->name('staff.')
    ->group(function () {
        Route::get('/dashboard', [StaffDashboardController::class, 'index'])
            ->name('dashboard');
        Route::get('/tickets', [StaffTicketController::class, 'index'])->name('tickets.index');
        Route::get('/tickets/{id}', [StaffTicketController::class, 'show'])->name('tickets.show');
        Route::post('/tickets/{id}/status', [StaffTicketController::class, 'updateStatus'])->name('tickets.updateStatus');
    });


Route::middleware(['auth', 'role:staff'])
    ->prefix('staff')
    ->name('staff.')
    ->group(function () {

        Route::get('/invoices', [StaffInvoiceController::class, 'index'])->name('invoices.index');
        Route::get('/invoices/create', [StaffInvoiceController::class, 'create'])->name('invoices.create');
        Route::post('/invoices/store', [StaffInvoiceController::class, 'store'])->name('invoices.store');

        Route::get('/invoices/{id}', [StaffInvoiceController::class, 'show'])->name('invoices.show');
        Route::get('/invoices/{id}/edit', [StaffInvoiceController::class, 'edit'])->name('invoices.edit');
        Route::put('/invoices/{id}', [StaffInvoiceController::class, 'update'])->name('invoices.update');

        Route::post('/invoices/{id}/status', [StaffInvoiceController::class, 'updateStatus'])->name('invoices.status');
    });

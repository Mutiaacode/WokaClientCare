<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

class AdminPaymentController extends Controller
{
    public function index(Request $request)
{
    $status = $request->status;

    $payments = Payment::with(['invoice.contract.client.user'])
        ->when($status, function ($query) use ($status) {
            $query->whereHas('invoice', function ($q) use ($status) {
                $q->where('status', $status); 
            });
        })
        ->latest()
        ->get();

    $notFound = ($status && $payments->count() == 0);

    return view('admin.payments.index', compact('payments', 'status', 'notFound'));
}


    public function show($id)
    {
        $payments = Payment::with(['invoice.contract.client.user'])->findOrFail($id);
        return view('admin.payments.show', compact('payments'));
    }

    public function verify(Request $request, $id)
    {
        $payment = Payment::findOrFail($id);
        $invoice = $payment->invoice;

        $payment->update([
            'diverifikasi_oleh' => Auth::id(),
            'tanggal_verifikasi' => now(),
        ]);

        $invoice->update([
            'status' => 'paid',
        ]);

        return redirect()->route('admin.payments.index')->with('sukses', 'status invoice berhasil dirubah');
    }
}

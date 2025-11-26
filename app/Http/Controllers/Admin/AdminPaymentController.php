<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use Illuminate\Http\Request;
use App\Models\Payment;
use Illuminate\Support\Facades\Auth;

class AdminPaymentController extends Controller
{
    public function index()
    {
        $payments = Payment::with(['invoice.contract.client.user'])->latest()->get();
        return view('admin.payments.index', compact('payments'));
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

<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientInvoiceController extends Controller
{
    // List semua invoice milik client
    public function index()
    {
        $clientId = Auth::user()->client->id;

        $invoices = Invoice::whereHas('contract', function ($q) use ($clientId) {
            $q->where('client_id', $clientId);
        })->latest()->get();

        return view('client.invoice.index', compact('invoices'));
    }

    // Detail invoice
    public function show($id)
    {
        $clientId = Auth::user()->client->id;

        $invoice = Invoice::whereHas('contract', function ($q) use ($clientId) {
            $q->where('client_id', $clientId);
        })->findOrFail($id);

        return view('client.invoice.show', compact('invoice'));
    }

    // Upload bukti pembayaran
   public function uploadPayment(Request $request, $id)
{
    $request->validate([
        'bukti_pembayaran' => 'required|mimes:jpg,jpeg,png,pdf|max:2048',
    ]);

    $invoice = Invoice::findOrFail($id);

    // upload file
    $path = $request->file('bukti_pembayaran')->store('bukti_pembayaran', 'public');

    // buat payment record baru
    Payment::create([
        'invoice_id' => $invoice->id,
        'jumlah_dibayar' => $invoice->total,
        'tanggal_pembayaran' => now(),
        'metode' => 'manual',
        'bukti_pembayaran' => $path,
    ]);

    return redirect()->back()
        ->with('success', 'Bukti pembayaran berhasil dikirim! Menunggu verifikasi admin.');
}

public function pay($id)
{
    $invoice = Invoice::with('payments')->findOrFail($id);

    return view('client.invoice.pay', compact('invoice'));
}

}
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
    public function index(Request $request)
    {
        $clientId = Auth::user()->client->id;

        $keyword = $request->keyword;

        $invoices = Invoice::whereHas('contract', function ($q) use ($clientId) {
            $q->where('client_id', $clientId);
        })
        ->when($keyword, function ($query) use ($keyword) {

            $query->where(function ($q) use ($keyword) {

                // cari berdasarkan nomor invoice atau status
                $q->where('nomor_invoice', 'LIKE', "%{$keyword}%")
                  ->orWhere('status', 'LIKE', "%{$keyword}%");

                // cari berdasarkan nomor kontrak melalui relasi
                $q->orWhereHas('contract', function ($contractQuery) use ($keyword) {
                    $contractQuery->where('nomor_kontrak', 'LIKE', "%{$keyword}%");
                });

            });
        })
        ->latest()
        ->get();

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

    public function search(Request $request)
    {
        $client = Auth::user()->client;

        $keyword = $request->keyword;

        $invoices = Invoice::whereHas('contract', function ($q) use ($client) {
            $q->where('client_id', $client->id);
        })
            ->where(function ($query) use ($keyword) {
                $query->where('invoice_number', 'LIKE', "%{$keyword}%")
                    ->orWhere('status', 'LIKE', "%{$keyword}%");
            })
            ->get();

        return view('client.invoice.index', compact('invoices'));
    }

}
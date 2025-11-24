<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Contract;
use Illuminate\Http\Request;

class AdminInvoiceController extends Controller
{
    public function index()
    {
        $invoices = Invoice::with(['contract.client.user'])->latest()->get();
        return view('admin.invoices.index', compact('invoices'));
    }

    public function create()
    {
        $contracts = Contract::with('client.user')->get();
        return view('admin.invoices.create', compact('contracts'));
    }

    private function generateNomorInvoice()
    {
        $last = Invoice::orderBy('id', 'desc')->first();
        $num = $last ? $last->id + 1 : 1;
        return 'INV-' . date('Y') . '-' . str_pad($num, 4, '0', STR_PAD_LEFT);
    }

    public function store(Request $request)
    {
        $request->validate([
            'contract_id' => 'required|exists:contracts,id',
        ]);

        $contract = Contract::findOrFail($request->contract_id);

        $harga = $contract->harga_layanan;
        $diskon = $request->diskon ?? 0;
        $pajak = $request->pajak ?? 0;

        $subtotal = $harga - $diskon;
        $total = $subtotal + $pajak;

        Invoice::create([
            'client_id' => $contract->client_id,
            'contract_id' => $contract->id,
            'nomor_invoice' => $this->generateNomorInvoice(),
            'tanggal_terbit' => now(),
            'tanggal_jatuh_tempo' => now()->addDays(7),
            'subtotal' => $subtotal,
            'pajak' => $pajak,
            'diskon' => $diskon,
            'periode' => $contract->periode_tagihan,
            'total' => $total,
            'status' => 'unpaid',
        ]);

        return redirect()->route('admin.invoices.index')
            ->with('sukses', 'Invoice berhasil dibuat.');
    }

    public function show($id)
    {
        $invoice = Invoice::with(['contract.client.user'])->findOrFail($id);
        return view('admin.invoices.show', compact('invoice'));
    }

    public function destroy($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->delete();

        return redirect()->route('admin.invoices.index')
            ->with('sukses', 'Invoice berhasil dihapus.');
    }
}

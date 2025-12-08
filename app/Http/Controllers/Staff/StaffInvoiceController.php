<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\Invoice;
use App\Models\Ticket;
use App\Models\User;
use App\Models\Contract;
use Illuminate\Http\Request;

class StaffInvoiceController extends Controller
{
    // LIST semua invoice yang dibuat staff
    public function index(Request $request)
    {
        $search = $request->search;

        $invoices = Invoice::with(['contract.client.user'])
            ->when($search, function ($query) use ($search) {

                $query->where('nomor_invoice', 'LIKE', "%{$search}%")
                    ->orWhereHas('contract.client.user', function ($q) use ($search) {
                        $q->where('name', 'LIKE', "%{$search}%");
                    });
            })
            ->latest()
            ->get();

        $notFound = ($search && $invoices->count() == 0);

        return view('staff.invoices.index', compact('invoices', 'search', 'notFound'));
    }
    // FORM CREATE
    public function create()
    {
        $clients = User::where('role', 'client')->get();
        $contracts = Contract::all();

        return view('staff.invoices.create', compact('clients', 'contracts'));
    }

    // PROSES SIMPAN DATA
    public function store(Request $request)
    {
        $data = $request->validate([
            'client_id' => 'required',
            'contract_id' => 'required',
            'nomor_invoice' => 'required|numeric',
            'tanggal_terbit' => 'required|date',
            'catatan' => 'nullable',
        ]);

        // Nomor invoice otomatis
        $data['number'] = 'INV-' . now()->format('YmdHis');

        $data['status'] = 'draft';
        $data['created_by'] = auth()->id();

        Invoice::create($data);

        return redirect()->route('staff.invoices.index')
            ->with('success', 'Invoice berhasil dibuat!');
    }

    // TAMPIL DETAIL
    public function show($id)
    {
        $invoice = Invoice::findOrFail($id);
        return view('staff.invoices.show', compact('invoice'));
    }

    // FORM EDIT
    public function edit($id)
    {
        $invoice = Invoice::findOrFail($id);

        $clients = User::where('role', 'client')->get();
        $contracts = Contract::all();

        return view('staff.invoices.edit', compact('invoice', 'clients', 'contracts'));
    }

    // PROSES UPDATE
    public function update(Request $request, $id)
    {
        $invoice = Invoice::findOrFail($id);

        $data = $request->validate([
            'client_id' => 'required',
            'contract_id' => 'required',
            'amount' => 'required|numeric',
            'due_date' => 'required|date',
            'description' => 'nullable',
        ]);

        $data['updated_by'] = auth()->id();

        $invoice->update($data);

        return redirect()->route('staff.invoices.show', $invoice->id)
            ->with('success', 'Invoice berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->delete();

        return redirect()->route('staff.invoices.index')
            ->with('success', 'Invoice berhasil dihapus!');
    }


}

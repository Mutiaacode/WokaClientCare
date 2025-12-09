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
        $staffId = auth()->id();

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

        $invoices = Invoice::whereHas('contract', function ($q) use ($staffId) {
            $q->where('staff_id', $staffId);
        })
            ->with(['contract.client.user'])
            ->get();
        return view('staff.invoices.index', compact('invoices', 'search', 'notFound'));
    }

    // TAMPIL DETAIL
    public function show($id)
    {
        $invoice = Invoice::findOrFail($id);
        return view('staff.invoices.show', compact('invoice'));
    }

    public function destroy($id)
    {
        $invoice = Invoice::findOrFail($id);
        $invoice->delete();

        return redirect()->route('staff.invoices.index')
            ->with('sukses', 'Invoice berhasil dihapus.');
    }

}

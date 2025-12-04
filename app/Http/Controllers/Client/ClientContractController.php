<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientContractController extends Controller
{
    public function index(Request $request)
{
    $client = Auth::user()->client;
    $search = $request->search;

    $query = Contract::where('client_id', $client->id);

    if ($search) {
        $query->where(function ($q) use ($search) {
            $q->where('nomor_kontrak', 'like', "%$search%")
              ->orWhere('tipe_kontrak', 'like', "%$search%")
              ->orWhereHas('product', function ($q2) use ($search) {
                  $q2->where('nama_produk', 'like', "%$search%");
              });
        });
    }

    $contracts = $query->get();

    return view('client.contract.index', compact('contracts', 'search'));
}

    public function show($id)
    {
        $contract = Contract::with(['client', 'product'])->findOrFail($id);
        return view('client.contract.show', compact('contract'));
    }

    public function approve($id)
    {
        $contract = Contract::where('id', $id)
            ->where('client_id', Auth::user()->client->id)
            ->firstOrFail();

        // update status
        $contract->status = 'aktif';
        $contract->save();

        return redirect()->route('client.contract.index')
            ->with('success', 'Kontrak berhasil di ACC.');
    }

}

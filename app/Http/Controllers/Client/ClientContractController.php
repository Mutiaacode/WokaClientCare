<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientContractController extends Controller
{
    public function index()
    {
        $client = Auth::user()->client;

        // jika tidak ada relasi client->contracts(), pake cara universal ini
        $contracts = Contract::where('client_id', $client->id)->get();

        return view('client.contract.index', compact('contracts'));
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

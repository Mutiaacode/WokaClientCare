<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\Client;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminContractController extends Controller
{
    private function generateNomorKontrak()
    {
        $tahun = date('Y');
        $last = Contract::whereYear('created_at', $tahun)->orderBy('id', 'desc')->first();
        $next = $last ? ((int) substr($last->nomor_kontrak, -4)) + 1 : 1;

        return 'WOKA-' . $tahun . '-' . str_pad($next, 4, '0', STR_PAD_LEFT);
    }

    public function index()
    {
        $contracts = Contract::with(['client', 'product'])->get();
        return view('admin.contract.index', compact('contracts'));
    }

    public function create()
    {
        $clients = Client::all();
        $products = Product::all();

        return view('admin.contract.create', compact('clients', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id'       => 'required|exists:clients,id',
            'produk_id'       => 'required|exists:products,id',
            'tipe_kontrak'    => 'required|in:langganan,satu_kali',
            'periode_tagihan' => 'nullable|in:bulanan,tahunan',
            'tanggal_mulai'   => 'required|date',
            'tanggal_berakhir'=> 'required|date|after:tanggal_mulai',
            'harga_layanan'   => 'required|numeric',
            'file_kontrak'    => 'nullable|mimes:pdf,doc,docx|max:4096',
            'catatan'         => 'nullable|string',
        ]);

        $data = $request->all();
        $data['nomor_kontrak'] = $this->generateNomorKontrak();

        if ($request->tipe_kontrak === 'satu_kali') {
            $data['periode_tagihan'] = null;
        }

        $product = Product::find($request->produk_id);
        $data['nama_layanan'] = $product->nama_produk;

        if ($request->hasFile('file_kontrak')) {
            $data['file_kontrak'] = $request->file('file_kontrak')->store('kontrak', 'public');
        }

        Contract::create($data);

        return redirect()->route('admin.contract.index')->with('sukses', 'Kontrak berhasil dibuat!');
    }

    public function edit(Contract $contract)
    {
        $clients = Client::all();
        $products = Product::all();

        return view('admin.contract.edit', compact('contract', 'clients', 'products'));
    }

    public function update(Request $request, Contract $contract)
    {
        $request->validate([
            'client_id' => 'required|exists:clients,id',
            'produk_id' => 'required|exists:products,id',
            'nomor_kontrak' => 'required|unique:contracts,nomor_kontrak,' . $contract->id,
            'tipe_kontrak' => 'required|in:langganan,satu_kali',
            'periode_tagihan' => 'nullable|in:bulanan,tahunan',
            'tanggal_mulai' => 'required|date',
            'tanggal_berakhir' => 'required|date|after:tanggal_mulai',
            'harga_layanan' => 'required|numeric',
            'file_kontrak' => 'nullable|mimes:pdf,doc,docx|max:4096',
            'catatan' => 'nullable|string',
        ]);

        $data = $request->all();

        if ($request->tipe_kontrak === 'satu_kali') {
            $data['periode_tagihan'] = null;
        }

        $product = Product::find($request->produk_id);
        $data['nama_layanan'] = $product->nama_produk;

        if ($request->hasFile('file_kontrak')) {
            if ($contract->file_kontrak && Storage::disk('public')->exists($contract->file_kontrak)) {
                Storage::disk('public')->delete($contract->file_kontrak);
            }

            $data['file_kontrak'] = $request->file('file_kontrak')->store('kontrak', 'public');
        }

        $contract->update($data);

        return redirect()->route('admin.contract.index')->with('sukses', 'Kontrak berhasil diperbarui!');
    }

    public function destroy(Contract $contract)
    {
        if ($contract->file_kontrak && Storage::disk('public')->exists($contract->file_kontrak)) {
            Storage::disk('public')->delete($contract->file_kontrak);
        }

        $contract->delete();

        return redirect()->route('admin.contract.index')->with('sukses', 'Kontrak berhasil dihapus!');
    }

    public function show(Contract $contract)
    {
        $contract->load(['client', 'product']);
        return view('admin.contract.show', compact('contract'));
    }
}

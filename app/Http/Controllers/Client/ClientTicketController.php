<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Ticket;
use App\Models\Contract;
use Illuminate\Support\Facades\Storage;

class ClientTicketController extends Controller
{
    public function index()
    {
        $clientId = Auth::user()->client->id;

        $tickets = Ticket::where('client_id', $clientId)
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('client.ticket.index', compact('tickets'));
    }

    public function create()
    {
        // ambil kontrak milik client untuk dipilih
        $contracts = Contract::where('client_id', Auth::user()->client->id)->get();
        return view('client.ticket.create', compact('contracts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'prioritas' => 'required|in:rendah,sedang,tinggi,urgent',
            'contract_id' => 'required|exists:contracts,id',
            'lampiran' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $clientId = Auth::user()->client->id;

        $ticket = new Ticket();
        $ticket->client_id = $clientId;
        $ticket->contract_id = $request->contract_id;
        $ticket->judul = $request->judul;
        $ticket->deskripsi = $request->deskripsi;
        $ticket->prioritas = $request->prioritas;
        $ticket->status = 'open'; // default status tiket saat dibuat

        // upload bukti lampiran (opsional)
        if ($request->hasFile('lampiran')) {
            $ticket->lampiran = $request->file('lampiran')->store('tickets', 'public');
        }

        $ticket->save();

        return redirect()->route('client.ticket.index')->with('success', 'Tiket berhasil dibuat!');
    }

    public function show($id)
    {
        $clientId = Auth::user()->client->id;

        // hanya boleh lihat tiket milik sendiri
        $ticket = Ticket::where('id', $id)
            ->where('client_id', $clientId)
            ->firstOrFail();

        return view('client.ticket.show', compact('ticket'));
    }
}

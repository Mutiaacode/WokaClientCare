<?php

namespace App\Http\Controllers\Teknisi;

use App\Http\Controllers\Controller;
use App\Models\Contract;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TeknisiTicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::where('teknisi_id', Auth::id())->get();
        return view('teknisi.ticket.index', compact('tickets'));
    }

    public function show($id)
    {
        $ticket = Ticket::findOrFail($id);
        return view('teknisi.ticket.show', compact('ticket'));
    }

    public function updateStatus(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);

        $ticket->update([
            'status' => $request->status,
            'catatan_penyelesaian' => $request->note,
            'lampiran' => $request->lampiran ?? null
        ]);

        return redirect()->route('teknisi.tickets.index')
            ->with('success', 'Status tiket diperbarui!');
    }

     public function search(Request $request)
    {
        $query = Ticket::where('teknisi_id', auth()->id());

        if ($request->search != '') {
            $keyword = $request->search;

            $query->whereHas('client.user', function ($q) use ($keyword) {
                $q->where('name', 'like', "%$keyword%");
            });
        }

        $tickets = $query->get();

        return view('teknisi.ticket.index', compact('tickets'));
    }
}

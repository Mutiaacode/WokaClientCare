<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class StaffTicketController extends Controller
{
 
    public function index()
    {
        $tickets = Ticket::where('teknisi_id', Auth::id())
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('staff.tickets.index', compact('tickets'));
    }

  
    public function show($id)
    {
        $ticket = Ticket::where('teknisi_id', Auth::id())->findOrFail($id);

        return view('staff.tickets.show', compact('ticket'));
    }


    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:open,in_progress,completed',
            'catatan' => 'nullable|string',
            'bukti' => 'nullable|image|max:2048'
        ]);

        $ticket = Ticket::where('assigned_to', Auth::id())->findOrFail($id);


        $buktiPath = $ticket->bukti ?? null;

        if ($request->hasFile('bukti')) {
            $buktiPath = $request->file('bukti')->store('ticket_bukti', 'public');
        }

        $ticket->update([
            'status' => $request->status,
            'catatan_staff' => $request->catatan,
            'bukti' => $buktiPath,
        ]);

        return redirect()->route('staff.tickets.index')->with('sukses', 'Status tiket berhasil diperbarui!');
    }
}

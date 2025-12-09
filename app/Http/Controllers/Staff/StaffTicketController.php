<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;

class StaffTicketController extends Controller
{

    public function index(Request $request)
    {
        $status = $request->status;

        $tickets = Ticket::with(['client.user'])
            ->when($status, function ($query) use ($status) {
                $query->where('status', $status);
            })
            ->latest()
            ->get();

        $notFound = ($status && $tickets->count() == 0);

        return view('staff.tickets.index', compact('tickets', 'status', 'notFound'));
    }


    public function show($id)
    {
        $ticket = Ticket::where('staff_id', Auth::id())->findOrFail($id);
        $teknisi = User::where('role', 'teknisi')->get();
        return view('staff.tickets.show', compact('ticket', 'teknisi'));
    }


    public function update(Request $request, Ticket $ticket)
    {
        $request->validate([
            'teknisi_id' => 'nullable|exists:users,id',
            'status' => 'required|in:open,in_progress,resolved,closed',
        ]);

        $ticket->update([
            'teknisi_id' => $request->teknisi_id,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('staff.tickets.index')
            ->with('sukses', 'Tiket berhasil diperbarui.');

    }
}

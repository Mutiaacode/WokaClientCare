<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;

class AdminTicketController extends Controller
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

    return view('admin.tickets.index', compact('tickets', 'status', 'notFound'));
}


    public function show(Ticket $ticket)
    {
        $ticket->load(['client.user']);
        $staff = User::where('role', 'staff')->get();

        return view('admin.tickets.show', compact('ticket', 'staff'));
    }

    public function update(Request $request, Ticket $ticket)
    {
        $request->validate([
            'staff_id' => 'nullable|exists:users,id',
            'status'=> 'required|in:open,in_progress,waiting_tech,resolved,closed',
        ]);

        $ticket->update([
            'staff_id' => $request->staff_id,
            'status' => $request->status,
        ]);

        return redirect()
            ->route('admin.tickets.show', $ticket->id)
            ->with('sukses', 'Tiket berhasil diperbarui.');
    }

    public function destroy(Ticket $ticket)
    {
        $ticket->delete();

        return redirect()
            ->route('admin.tickets.index')
            ->with('sukses', 'Tiket berhasil dihapus.');
    }
}

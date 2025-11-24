<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ticket;
use App\Models\User;
use Illuminate\Http\Request;

class AdminTicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::with(['client.user'])->latest()->get();
        return view('admin.tickets.index', compact('tickets'));
    }

    public function show($id)
    {
        $ticket = Ticket::with(['client.user'])->findOrFail($id);
        $staff = User::where('role', 'staff')->get();

        return view('admin.tickets.show', compact('ticket', 'staff'));
    }

    public function update(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);

        $request->validate([
            'assigned_staff_id' => 'nullable|exists:users,id',
            'status' => 'required|in:open,in_progress,waiting_tech,resolved,closed'
        ]);

        $ticket->update([
            'assigned_staff_id' => $request->assigned_staff_id,
            'status'            => $request->status,
        ]);

        return redirect()->route('admin.tickets.show', $ticket->id)
                         ->with('sukses', 'Tiket berhasil diperbarui.');
    }

    public function destroy($id)
    {
        Ticket::destroy($id);
        return redirect()->route('admin.tickets.index')->with('sukses', 'Tiket berhasil dihapus.');
    }
}
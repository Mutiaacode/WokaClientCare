<?php

namespace App\Http\Controllers\Staff;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\User;
use App\Models\TicketLog;

class StaffTiketController extends Controller
{
    // ----------------------
    // 1. Dashboard Staff
    // ----------------------
    public function dashboard()
    {
        $tickets = Ticket::where('staff_id', auth()->id())->get();

        $stats = [
            'open' => Ticket::where('staff_id', auth())->where('status', 'open')->count(),
            'in_progress' => Ticket::where('staff_id', auth()->id())->where('status', 'in_progress')->count(),
            'waiting_tech' => Ticket::where('staff_id', auth()->id())->where('status', 'waiting_tech')->count(),
        ];

        return view('staff.dashboard', compact('tickets', 'stats'));
    }

    // ----------------------
    // 2. List Ticket
    // ----------------------
    public function index()
    {
        $tickets = Ticket::where('staff_id', auth()->id())->paginate(10);
        return view('staff.tickets.index', compact('tickets'));
    }

    // ----------------------
    // 3. Detail Ticket
    // ----------------------
    public function show($id)
    {
        $ticket = Ticket::where('id', $id)
            ->where('staff_id', auth()->id())
            ->firstOrFail();

        $technicians = User::where('role', 'technician')->get();

        return view('staff.tickets.show', compact('ticket', 'technicians'));
    }


    // ----------------------
    // 4. Start Ticket (open -> in_progress)
    // ----------------------
    public function start($id)
    {
        $ticket = Ticket::findOrFail($id);

        if ($ticket->status !== 'open') {
            return back()->with('error', 'Ticket tidak dalam status OPEN.');
        }

        $ticket->update([
            'status' => 'in_progress',
        ]);

        TicketLog::create([
            'ticket_id' => $id,
            'user_id' => auth(),
            'action' => 'Ticket moved to IN PROGRESS',
        ]);

        return back()->with('success', 'Ticket telah diambil staff.');
    }

    // ----------------------
    // 5. Assign Teknisi (in_progress -> waiting_tech)
    // ----------------------
    public function assignTechnician(Request $request, $id)
    {
        $ticket = Ticket::findOrFail($id);

        $request->validate([
            'technician_id' => 'required',
            'log' => 'required'
        ]);

        $ticket->update([
            'technician_id' => $request->technician_id,
            'status' => 'waiting_tech',
        ]);

        TicketLog::create([
            'ticket_id' => $id,
            'user_id' => auth()->id,
            'action' => 'Assign technician: ' . $request->technician_id,
            'notes' => $request->log,
        ]);

        return back()->with('success', 'Teknisi berhasil ditugaskan.');
    }
}

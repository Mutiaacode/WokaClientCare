@extends('layouts.app')

@section('content')

    <div class="card shadow border-0 rounded-4 p-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0">Detail Ticket</h4>
        </div>

        <div class="row g-4">
            <div class="col-md-6">
                <label class="fw-semibold">Nama Client:</label>
                <div class="border rounded px-3 py-2 bg-light">{{ $ticket->client->user->name ?? '-' }}</div>
            </div>
            <div class="col-md-6">
                <label class="fw-semibold">Staff Pengirim:</label>
                <div class="border rounded px-3 py-2 bg-light">{{ $ticket->staff->name ?? '-' }}</div>
            </div>
            <div class="col-md-6">
                <label class="fw-semibold">Jenis Usaha Client:</label>
                <div class="border rounded px-3 py-2 bg-light">{{ $ticket->client->nama_usaha ?? '-' }}</div>
            </div>
            <div class="col-6">
                <label class="fw-semibold">Judul Masalah:</label>
                <div class="border rounded px-3 py-2 bg-light">{{ $ticket->judul }}</div>
            </div>
            <div class="col-12">
                <label class="fw-semibold">Tingkat Prioritas:</label>
                <div class="border rounded px-3 py-2 bg-light">{{ $ticket->prioritas }}</div>
            </div>
            <div class="col-12">
                <label class="fw-semibold">Status Ticket:</label>
                <select name="status" class="form-control border rounded px-3 py-2 bg-light" required>
                    <option value="open" @selected($ticket->status == 'open')>Open</option>
                    <option value="in_progress" @selected($ticket->status == 'in_progress')>In Progress</option>
                    <option value="resolved" @selected($ticket->status == 'resolved')>Selesai</option>
                    <option value="closed" @selected($ticket->status == 'closed')>Closed</option>
                </select>
            </div>
            <div class="col-12">
                <label class="fw-semibold">Deskripsi Masalah:</label>
                <div class="border rounded px-3 py-2 bg-light">{{ $ticket->deskripsi }}</div>
            </div>
            <div class="d-flex align-items-center mb-4">
                <a href="{{ route('teknisi.ticket.index') }}" class="btn btn-secondary">
                    <i class="ti ti-arrow-left"></i> Kembali
                </a>
                <button class="btn btn-primary ms-2">
                    <i class="ti ti-device-floppy"></i> Simpan
                </button>
            </div>

        </div>
    </div>


@endsection
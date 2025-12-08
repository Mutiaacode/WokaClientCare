@extends('layouts.app')

@section('title', 'Detail Tiket - Admin') 

@section('content')
    @if (session('sukses'))
        <div class="alert alert-success mt-3 px-4">{{ session('sukses') }}</div>
    @endif
    <div class="card shadow-sm border-0 rounded-3 p-4">

        <h4 class="fw-bold mb-4">Detail Tiket</h4>

        <div class="mb-3"><strong>Judul:</strong> {{ $ticket->judul }}</div>
        <div class="mb-3"><strong>Deskripsi:</strong> {!! nl2br(e($ticket->deskripsi)) !!}</div>
        <div class="mb-3"><strong>Client:</strong> {{ $ticket->client->user->name }}</div>
        <div class="mb-3"><strong>Status:</strong> {{ ucfirst($ticket->status) }}</div>

        <form action="{{ route('admin.tickets.update', $ticket->id) }}" method="POST">
            @csrf @method('PUT')

            <div class="mb-3">
                <label>Assign ke Staff</label>
                <select name="staff_id" class="form-control">
                    <option value="">--- Tidak Assign ---</option>
                    @foreach ($staff as $s)
                        <option value="{{ $s->id }}" @selected($ticket->staff_id == $s->id)>
                            {{ $s->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label>Status Tiket</label>
                <select name="status" class="form-control" required>
                    <option value="open" @selected($ticket->status == 'open')>Open</option>
                    <option value="in_progress" @selected($ticket->status == 'in_progress')>In Progress</option>
                    <option value="waiting_tech" @selected($ticket->status == 'waiting_tech')>Menunggu Teknisi</option>
                    <option value="resolved" @selected($ticket->status == 'resolved')>Selesai</option>
                    <option value="closed" @selected($ticket->status == 'closed')>Closed</option>
                </select>
            </div>

            <div class="d-flex justify-content-end mt-3 gap-2">
                <a href="{{ route('admin.tickets.index') }}" class="btn btn-light">
                    <i class="ti ti-arrow-left"></i> Kembali
                </a>
                <button class="btn btn-primary">
                    <i class="ti ti-device-floppy"></i> Simpan
                </button>
            </div>

        </form>
    </div>
@endsection

@extends('layouts.app')

@section('title', 'Detail Tiket')

@section('content')
<div class="card shadow border-0 rounded-4 p-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">Detail Tiket</h4>
        <a href="{{ route('client.ticket.index') }}" class="btn btn-secondary">
            <i class="ti ti-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="row mb-4">

        {{-- Judul Tiket --}}
        <div class="col-md-6 mb-3">
            <label class="text-muted small">Judul Tiket</label>
            <div class="fw-semibold">{{ $ticket->judul }}</div>
        </div>

        {{-- Status --}}
        <div class="col-md-6 mb-3">
            <label class="text-muted small">Status</label><br>
            <span class="badge
                @if($ticket->status == 'open') bg-secondary
                @elseif($ticket->status == 'in_progress') bg-info
                @elseif($ticket->status == 'resolved') bg-success
                @else bg-dark
                @endif px-3 py-2">
                {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
            </span>
        </div>

    </div>

    <hr>

    <div class="row mb-4">

        {{-- Kontrak Terkait --}}
        <div class="col-md-6 mb-3">
            <label class="text-muted small">Kontrak</label>
            <div class="fw-semibold">
                {{ $ticket->contract->nomor_kontrak }} —
                {{ $ticket->contract->product->nama_produk }}
            </div>
        </div>

        {{-- Prioritas --}}
        <div class="col-md-6 mb-3">
            <label class="text-muted small">Prioritas</label><br>
            <span class="badge
                @if($ticket->prioritas == 'rendah') bg-secondary
                @elseif($ticket->prioritas == 'sedang') bg-info
                @elseif($ticket->prioritas == 'tinggi') bg-warning text-dark
                @else bg-danger
                @endif px-3 py-2">
                {{ ucfirst($ticket->prioritas) }}
            </span>
        </div>

    </div>

    <hr>

    {{-- Deskripsi --}}
    <div class="mb-4">
        <label class="text-muted small">Deskripsi Masalah</label>
        <div class="fw-semibold">{{ $ticket->deskripsi }}</div>
    </div>

    <hr>

    {{-- Lampiran --}}
    <div>
        <label class="text-muted small">Lampiran</label><br>
        @if ($ticket->lampiran)
            <img src="{{ asset('storage/'.$ticket->lampiran) }}" 
                 class="img-thumbnail mt-2" width="250">
        @else
            <span class="text-muted">Tidak ada lampiran</span>
        @endif
    </div>

</div>
@endsection

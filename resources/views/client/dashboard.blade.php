@extends('layouts.app')

@section('title', 'Dashboard Client')

@section('content')

{{-- HEADER --}}
<div class="mb-4">
    <h4 class="fw-bold">Selamat datang, {{ Auth::user()->name }} 👋</h4>
    <p class="text-muted mb-0">Ringkasan layanan Anda</p>
</div>

{{-- TOP CARDS --}}
<div class="row mb-4 g-3">
    <div class="col-md-4">
        <div class="card border-0 shadow rounded-4">
            <div class="card-body d-flex align-items-center">
                <div class="me-3">
                    <i class="bi bi-file-earmark-text-fill fs-1 text-primary"></i>
                </div>
                <div>
                    <h6 class="text-dark mb-1">Kontrak Aktif</h6>
                    <h3 class="fw-bold">{{ $contractAktif }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-0 shadow rounded-4">
            <div class="card-body d-flex align-items-center">
                <div class="me-3">
                    <i class="bi bi-ticket-detailed-fill fs-1 text-info"></i>
                </div>
                <div>
                    <h6 class="text-dark mb-1">Tiket Aktif</h6>
                    <h3 class="fw-bold">{{ $ticketAktif }}</h3>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-0 shadow rounded-4">
            <div class="card-body d-flex align-items-center">
                <div class="me-3">
                    <i class="bi bi-currency-dollar fs-1 text-danger"></i>
                </div>
                <div>
                    <h6 class="text-dark mb-1">Invoice Belum Dibayar</h6>
                    <h3 class="fw-bold">{{ $invoiceBelumBayar }}</h3>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- TIKET TERBARU --}}
<div class="card shadow-sm rounded-4 border-0 mb-4">
    <div class="card-header bg-primary text-white fw-semibold fs-6">
        Tiket Terbaru
    </div>
    <ul class="list-group list-group-flush">
        @forelse($tiketTerbaru as $t)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <div>
                <strong>{{ $t->judul }}</strong>
                <span class="badge 
                    @if($t->status=='open') bg-secondary 
                    @elseif($t->status=='in_progress') bg-info 
                    @elseif($t->status=='resolved') bg-success 
                    @else bg-dark @endif ms-2">
                    {{ ucfirst(str_replace('_',' ',$t->status)) }}
                </span>
            </div>
            <a href="{{ route('client.ticket.show', $t->id) }}" class="btn btn-sm btn-outline-light border-0 shadow-sm">
                Lihat
            </a>
        </li>
        @empty
        <li class="list-group-item text-muted">Belum ada tiket yang dibuat.</li>
        @endforelse
    </ul>
</div>

{{-- MAINTENANCE TERDEKAT --}}
<div class="card shadow-sm rounded-4 border-0 mb-4">
    <div class="card-header bg-warning text-dark fw-semibold fs-6">
        Maintenance Terdekat
    </div>
    <ul class="list-group list-group-flush">
        @forelse($maintenances as $m)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <div>
                <strong>{{ $m->judul ?? 'Maintenance' }}</strong>
                <small class="text-muted d-block">{{ date('d-m-Y', strtotime($m->tanggal)) }}</small>
            </div>
            <span class="badge bg-dark rounded-pill">Terjadwal</span>
        </li>
        @empty
        <li class="list-group-item text-muted">Tidak ada jadwal maintenance terdekat.</li>
        @endforelse
    </ul>
</div>

@endsection

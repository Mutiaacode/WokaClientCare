@extends('layouts.app')

@section('title', 'Dashboard Client')

@section('content')

    {{-- HEADER --}}
    <div class="mb-4">
        <h4 class="fw-bold">Selamat datang, {{ Auth::user()->name }} 👋</h4>
        <p class="text-muted mb-0">Ringkasan layanan Anda</p>
    </div>

    {{-- TOP CARDS --}}
    <div class="row mb-4">
        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow rounded-4">
                <div class="card-body">
                    <h6 class="text-dark">Kontrak Aktif</h6>
                    <h3 class="fw-bold">{{ $contractAktif }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow rounded-4">
                <div class="card-body">
                    <h6 class="text-dark">Tiket Aktif</h6>
                    <h3 class="fw-bold">{{ $ticketAktif }}</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow rounded-4">
                <div class="card-body">
                    <h6 class="text-dark">Invoice Belum Dibayar</h6>
                    <h3 class="fw-bold">{{ $invoiceBelumBayar }}</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- TIKET TERBARU --}}
    <div class="card shadow-sm rounded-4 border-0 mb-4">
        <div class="card-header bg-primary text-white fw-semibold">
            Tiket Terbaru
        </div>
        <ul class="list-group list-group-flush">

            @forelse($tiketTerbaru as $t)
                <li class="list-group-item">
                    <strong>{{ $t->judul }}</strong>
                    <span class="badge 
                        @if($t->status=='open') bg-secondary 
                        @elseif($t->status=='in_progress') bg-info 
                        @elseif($t->status=='resolved') bg-success 
                        @else bg-dark @endif ms-2">
                        {{ ucfirst(str_replace('_',' ',$t->status)) }}
                    </span>

                    <a href="{{ route('client.ticket.show', $t->id) }}"
                       class="btn btn-sm btn-outline-primary float-end">
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
        <div class="card-header bg-warning fw-semibold">
            Maintenance Terdekat
        </div>
        <ul class="list-group list-group-flush">

            @forelse($maintenances as $m)
                <li class="list-group-item">
                    {{ $m->tanggal }} — {{ $m->judul ?? 'Maintenance' }}
                    <span class="badge bg-dark float-end">Terjadwal</span>
                </li>
            @empty
                <li class="list-group-item text-muted">Tidak ada jadwal maintenance terdekat.</li>
            @endforelse

        </ul>
    </div>

@endsection

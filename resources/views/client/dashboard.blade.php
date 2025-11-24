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
                    <h6 class="text-primary">Kontrak Aktif</h6>
                    <h3 class="fw-bold">0</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow rounded-4">
                <div class="card-body">
                    <h6 class="text-primary">Tiket Aktif</h6>
                    <h3 class="fw-bold">0</h3>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-3">
            <div class="card border-0 shadow rounded-4">
                <div class="card-body">
                    <h6 class="text-primary">Invoice Belum Dibayar</h6>
                    <h3 class="fw-bold">0</h3>
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
            
                <li class="list-group-item">
                    <strong>judul</strong>
                    <span class="badge bg-info text-dark ms-2">status</span>
                    <a href="#" class="btn btn-sm btn-outline-primary float-end">
                        Lihat
                    </a>
                </li>
        
                <li class="list-group-item text-muted">Belum ada tiket yang dibuat.</li>
           
        </ul>
    </div>

    {{-- MAINTENANCE DEKAT --}}
    <div class="card shadow-sm rounded-4 border-0 mb-4">
        <div class="card-header bg-warning fw-semibold">
            Maintenance Terdekat
        </div>
        <ul class="list-group list-group-flush">
           
                <li class="list-group-item">
                    jadwal maintenance
                    <span class="badge bg-dark float-end">status</span>
                </li>
           
                <li class="list-group-item text-muted">Tidak ada jadwal maintenance terdekat.</li>
          
        </ul>
    </div>

@endsection

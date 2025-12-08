@extends('layouts.app')

@section('content')

{{-- HEADER --}}
<div class="mb-5">
    <h2 class="fw-bold text-dark mb-1" style="letter-spacing:.4px">
        Dashboard
    </h2>
    <p class="text-muted mb-0">
        Ringkasan aktivitas sistem hari ini
    </p>
</div>

{{-- STATS CARDS --}}
<div class="row g-4">

    {{-- TOTAL TICKET --}}
    <div class="col-md-6">
        <div class="card border-0 rounded-4 h-100 shadow-sm hover-card">
            <div class="card-body p-4">

                <div class="d-flex align-items-center justify-content-between mb-3">
                    <span class="text-primary fw-semibold small text-uppercase">
                        Total Ticket
                    </span>

                    <div class="icon-circle bg-primary bg-opacity-10 text-primary">
                        <i class="bi bi-ticket-perforated"></i>
                    </div>
                </div>

                <h1 class="fw-bold text-dark mb-1">
                    {{ $totalTickets }}
                </h1>

                <span class="text-muted small">
                    Tiket terdaftar di sistem
                </span>

            </div>
        </div>
    </div>

    {{-- TOTAL MAINTENANCE --}}
    <div class="col-md-6">
        <div class="card border-0 rounded-4 h-100 shadow-sm hover-card">
            <div class="card-body p-4">

                <div class="d-flex align-items-center justify-content-between mb-3">
                    <span class="text-success fw-semibold small text-uppercase">
                        Maintenance
                    </span>

                    <div class="icon-circle bg-success bg-opacity-10 text-success">
                        <i class="bi bi-tools"></i>
                    </div>
                </div>

                <h1 class="fw-bold text-dark mb-1">
                    {{ $totalMaintenances }}
                </h1>

                <span class="text-muted small">
                    Jadwal maintenance aktif
                </span>

            </div>
        </div>
    </div>

</div>

{{-- STYLE TAMBAHAN --}}
<style>
    .icon-circle{
        width: 42px;
        height: 42px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
    }

    .hover-card{
        transition: all .25s ease;
    }

    .hover-card:hover{
        transform: translateY(-4px);
        box-shadow: 0 .75rem 1.5rem rgba(0,0,0,.08);
    }
</style>

@endsection

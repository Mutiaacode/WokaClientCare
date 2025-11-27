@extends('layouts.app')

@section('content')

    {{-- HEADER --}}
    <div class="mb-4">
        <h3 class="fw-bold text-dark mb-1" style="letter-spacing: .5px;">
            Dashboard
        </h3>
        <p class="text-secondary" style="letter-spacing: .3px;">
            Ringkasan data dalam sistem
        </p>
    </div>

    {{-- TOP CARDS --}}
    <div class="row g-4">

        {{-- TOTAL TICKET --}}
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h6 class="fw-semibold text-primary m-0" style="letter-spacing: 1px;">
                            TOTAL TICKET
                        </h6>

                        <span class="badge bg-primary bg-opacity-10 text-primary p-2 rounded-3">
                            <i class="bi bi-ticket-perforated"></i>
                        </span>
                    </div>

                    <h1 class="fw-bold text-dark display-6" style="line-height: 1.2;">
                        {{ $totalTickets }}
                    </h1>

                    <p class="text-muted small mb-0" style="letter-spacing: .3px;">
                        Total semua tiket yang terdaftar
                    </p>
                </div>
            </div>
        </div>

        {{-- TOTAL MAINTENANCE --}}
        <div class="col-md-6">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body">

                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <h6 class="fw-semibold text-success m-0" style="letter-spacing: 1px;">
                            TOTAL MAINTENANCE
                        </h6>

                        <span class="badge bg-success bg-opacity-10 text-success p-2 rounded-3">
                            <i class="bi bi-tools"></i>
                        </span>
                    </div>

                    <h1 class="fw-bold text-dark display-6" style="line-height: 1.2;">
                        {{ $totalMaintenances }}
                    </h1>

                    <p class="text-muted small mb-0" style="letter-spacing: .3px;">
                        Jumlah seluruh jadwal maintenance
                    </p>

                </div>
            </div>
        </div>

    </div>

@endsection

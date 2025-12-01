@extends('layouts.app')

@section('content')
    <div class="container">

        <h3>Dashboard Staff</h3>

        <div class="mb-4">
            <p class="text-muted mb-0">Ringkasan data dalam sistem</p>
        </div>
        <div class="row mb-4">
            <div class="col-md-6 mb-6">
                <div class="card border-0 shadow rounded-4">
                    <div class="card-body">
                        <h6 class="text-primary">Total Ticket</h6>
                        <h3 class="fw-bold">{{ $totalTickets     }}</h3>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-6">
                <div class="card border-0 shadow rounded-4">
                    <div class="card-body">
                        <h6 class="text-primary">Total ivoices</h6>
                        <h3 class="fw-bold">{{ $totalInvoices }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
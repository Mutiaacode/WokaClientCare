@extends('layouts.app')

@section('content')
    <div class="card shadow border-0 rounded-3 p-4">

        <h4 class="fw-bold mb-4">Detail Invoice</h4>

        <div class="mb-3">
            <strong>Invoice:</strong> #INV-{{ $invoice->id }}
        </div>

        <div class="mb-3">
            <strong>Client:</strong> {{ $invoice->contract->client->user->name }}
        </div>

        <div class="mb-3">
            <strong>Kontrak:</strong> {{ $invoice->contract->nomor_kontrak }}
        </div>

        <div class="mb-3">
            <strong>Subtotal:</strong> Rp {{ number_format($invoice->subtotal, 0, ',', '.') }}
        </div>

        <div class="mb-3">
            <strong>Pajak:</strong> Rp {{ number_format($invoice->pajak, 0, ',', '.') }}
        </div>

        <div class="mb-3">
            <strong>Total:</strong>
            <span class="fw-bold">Rp {{ number_format($invoice->total, 0, ',', '.') }}</span>
        </div>

        <div class="mb-3">
            <strong>Status:</strong>
            <span class="badge bg-warning text-dark">{{ ucfirst($invoice->status) }}</span>
        </div>

        <div class="d-flex justify-content-end mt-3">
            <a href="{{ route('admin.invoices.index') }}" class="btn btn-secondary">
                <i class="ti ti-arrow-left"></i> Kembali
            </a>
        </div>

    </div>
@endsection

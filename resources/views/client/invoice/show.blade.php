@extends('layouts.app')

@section('title', 'Detail Invoice')

@section('content')

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card shadow border-0 rounded-4 p-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">Detail Invoice</h4>
        <a href="{{ route('client.invoice.index') }}" class="btn btn-secondary">
            <i class="ti ti-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="mb-3">
        <strong>Invoice:</strong> #INV-{{ $invoice->id }}
    </div>

    <div class="mb-3">
        <strong>Kontrak:</strong> {{ $invoice->contract->nomor_kontrak }}
    </div>

    <div class="mb-3">
        <strong>Total:</strong> 
        <span class="fw-bold">Rp {{ number_format($invoice->total, 0, ',', '.') }}</span>
    </div>

    <div class="mb-3">
        <strong>Status:</strong>
        <span class="badge 
            @if ($invoice->status == 'paid') bg-success
            @else bg-danger
            @endif
        px-3 py-2">
            {{ ucfirst($invoice->status) }}
        </span>
    </div>

    <hr>

    {{-- Tombol Download Invoice jika ada file --}}
    @if($invoice->file_invoice)
        <a href="{{ asset('storage/' . $invoice->file_invoice) }}"
           class="btn btn-outline-primary w-100 mb-3 mt-2" target="_blank">
            <i class="ti ti-download"></i> Download Invoice
        </a>
    @endif

    {{-- Jika belum bayar --}}
    @if ($invoice->status == 'unpaid')
        <form action="{{ route('client.invoice.upload', $invoice->id) }}" method="POST"
            enctype="multipart/form-data" class="mt-3">
            @csrf
            <label class="fw-semibold">Upload Bukti Pembayaran</label>
            <input type="file" name="bukti_pembayaran" class="form-control" required>

            <button class="btn btn-success w-100 mt-2"
                onclick="return confirm('Kirim bukti pembayaran ini?')">
                Kirim Pembayaran
            </button>
        </form>
    @endif

    {{-- Jika sudah upload bukti pembayaran --}}
    @if ($invoice->payments->last() && $invoice->payments->last()->bukti_pembayaran)
        <div class="mt-4">
            <label class="fw-semibold">Bukti Pembayaran:</label><br>
            <a href="{{ asset('storage/' . $invoice->payments->last()->bukti_pembayaran) }}"
                class="btn btn-outline-dark w-100 mt-2" target="_blank">
                Lihat Bukti Pembayaran
            </a>
        </div>
    @endif

</div>

@endsection

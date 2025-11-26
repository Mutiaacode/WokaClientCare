@extends('layouts.app')

@section('title', 'Bayar Invoice')

@section('content')

@if (session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="card shadow border-0 rounded-4 p-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">Pembayaran Invoice</h4>
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
            @if($invoice->status == 'paid') bg-success
            @else bg-danger
            @endif px-3 py-2">
            {{ ucfirst($invoice->status) }}
        </span>
    </div>

    <hr>

    @php 
        $payment = $invoice->payments->last();
    @endphp

    {{-- JIKA BELUM BAYAR → TAMPILKAN FORM UPLOAD --}}
    @if ($invoice->status == 'unpaid')
        <form action="{{ route('client.invoice.upload', $invoice->id) }}" 
              method="POST"
              enctype="multipart/form-data" class="mt-3">
              
            @csrf

            <label class="fw-semibold">Upload Bukti Pembayaran</label>
            <input type="file" name="bukti_pembayaran" class="form-control" required>

            <button class="btn btn-success w-100 mt-3"
                onclick="return confirm('Kirim bukti pembayaran ini?')">
                Kirim Pembayaran
            </button>
        </form>
    @endif

    {{-- JIKA SUDAH UPLOAD BUKTI --}}
    @if ($payment && $payment->bukti_pembayaran)
        <div class="mt-4">
            <label class="fw-semibold">Bukti Pembayaran:</label><br>

            <button class="btn btn-outline-dark w-100 mt-2" 
                    data-bs-toggle="modal" 
                    data-bs-target="#modalBukti">
                Lihat Bukti Pembayaran
            </button>
        </div>

        {{-- MODAL POPUP --}}
        <div class="modal fade" id="modalBukti" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">

                    <div class="modal-header">
                        <h5 class="modal-title">Bukti Pembayaran</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>

                    <div class="modal-body text-center">
                        <img src="{{ asset('storage/' . $payment->bukti_pembayaran) }}" 
                             class="img-fluid rounded shadow"
                             alt="Bukti Pembayaran">
                    </div>

                </div>
            </div>
        </div>
    @endif

</div>

@endsection

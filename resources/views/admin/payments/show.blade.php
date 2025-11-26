@extends('layouts.app')

@section('content')
    <div class="card shadow-sm border-0 rounded-3 p-4">

        <h4 class="fw-bold mb-3">Detail Pembayaran</h4>

        <div class="mb-3">
            <strong>Client:</strong>
            {{ $payments->invoice->contract->client->user->name }}
        </div>

        <div class="mb-3">
            <strong>Invoice:</strong>
            {{ $payments->invoice->nomor_invoice }}
        </div>

        <div class="mb-3">
            <strong>Jumlah Dibayar:</strong>
            Rp {{ number_format($payments->jumlah_dibayar, 0, ',', '.') }}
        </div>

        <div class="mb-3">
            <strong>Tanggal Pembayaran:</strong>
            {{ $payments->tanggal_pembayaran }}
        </div>

        <div class="mb-3">
            <strong>Bukti Pembayaran:</strong><br>
            @if ($payments->bukti_pembayaran)
                <a href="{{ asset('storage/' . $payments->bukti_pembayaran) }}" target="_blank"
                    class="btn btn-primary btn-sm mt-2">
                    Lihat Bukti
                </a>
            @else
                <span class="text-muted">Belum ada bukti</span>
            @endif
        </div>

        <hr>

        @if ($payments->invoice->status === 'unpaid')
            <form action="{{ route('admin.payments.verify', $payments->id) }}" method="POST">
                @csrf

                <button class="btn btn-success w-100">
                    Verifikasi Pembayaran & Tandai Invoice Paid
                </button>
            </form>
        @else
            <div class="alert alert-success text-center">Invoice sudah dibayar</div>
        @endif

        <div class="text-end mt-3">
            <a href="{{ route('admin.payment.index') }}" class="btn btn-secondary">Kembali</a>
        </div>

    </div>
@endsection

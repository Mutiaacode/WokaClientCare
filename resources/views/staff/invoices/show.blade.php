@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <div class="invoice-container position-relative">
            <!-- Watermark -->
            <div class="watermark">INVOICE</div>

            <!-- Header -->
            <div class="invoice-header">
                <div class="row align-items-center">
                    <div class="col-md-6">
                        <div class="company-logo">WOKA PROJECT MANDIRI</div>
                        <p class="mb-0 mt-2">Jl. Jambu, Tejosari Metro Timur</p>
                        <p class="mb-0">Metro, Indonesia</p>
                        <p class="mb-0">Telp: (021) 1234-5678</p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <h1 class="invoice-title text-white">INVOICE</h1>
                        <p class="mb-0">#INV-{{ $invoice->id }}</p>
                        <p class="mb-0">Tanggal: {{ date('d/m/Y', strtotime($invoice->created_at)) }}</p>
                        <p class="mb-0">
                            Tanggal Terbit:
                            {{ date('d/m/Y', strtotime($invoice->tanggal_terbit)) }}
                        </p>

                        <p class="mb-0">
                            Jatuh Tempo:
                            {{ date('d/m/Y', strtotime($invoice->tanggal_jatuh_tempo)) }}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Body -->
            <div class="invoice-body position-relative" style="z-index: 1;">
                <!-- Info Client -->
                <div class="row mb-4">
                    <div class="col-md-6">
                        <h5 class="fw-bold text-primary">Kepada:</h5>
                        <p class="mb-1 fw-bold">{{ $invoice->contract->client->user->name }}</p>
                        <p class="mb-1">Kontrak: {{ $invoice->contract->nomor_kontrak }}</p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <h5 class="fw-bold text-primary">Status:</h5>
                        <span class="status-badge bg-danger text-white">{{ ucfirst($invoice->status) }}</span>
                    </div>
                </div>

                <!-- Rincian Pembayaran -->
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-header bg-light">
                        <h5 class="mb-0 fw-bold">Rincian Pembayaran</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="detail-row px-4">
                            <div class="row">
                                <div class="col-6">Subtotal</div>
                                <div class="col-6 text-end">Rp {{ number_format($invoice->subtotal, 0, ',', '.') }}</div>
                            </div>
                        </div>
                        <div class="detail-row px-4">
                            <div class="row">
                                <div class="col-6">Pajak
                                    ({{ $invoice->pajak > 0 ? round(($invoice->pajak / $invoice->subtotal) * 100, 2) : 0 }}%)
                                </div>
                                <div class="col-6 text-end">Rp {{ number_format($invoice->pajak, 0, ',', '.') }}</div>
                            </div>
                        </div>
                        <div class="detail-row px-4 bg-light">
                            <div class="row fw-bold">
                                <div class="col-6">Total</div>
                                <div class="col-6 text-end amount-highlight">Rp
                                    {{ number_format($invoice->total, 0, ',', '.') }}</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Informasi Tambahan -->
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="fw-bold text-primary">Metode Pembayaran:</h6>
                        <p class="mb-2">Transfer Bank</p>
                        <p class="mb-1">Bank: BRI</p>
                        <p class="mb-1">No. Rekening: 123-456-7890</p>
                        <p class="mb-1">Atas Nama: RAHMAN ARDI SAPUTRA</p>
                    </div>
                    <div class="col-md-6">
                        <h6 class="fw-bold text-primary">Catatan:</h6>
                        <p>Harap melakukan pembayaran sebelum tanggal jatuh tempo. Terima kasih atas kerjasamanya.</p>
                    </div>
                </div>
            </div>

            <!-- Footer -->
            <div class="invoice-footer">
                <div class="row">
                    <div class="col-md-6">
                        <p class="mb-0 text-muted">Terima kasih atas kepercayaan Anda</p>
                    </div>
                    <div class="col-md-6 text-md-end">
                        <a href="{{ route('staff.invoices.index') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Kembali ke Daftar
                        </a>
                        <button class="btn btn-primary ms-2" onclick="window.print()">
                            <i class="bi bi-printer"></i> Cetak Invoice
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </html>
@endsection

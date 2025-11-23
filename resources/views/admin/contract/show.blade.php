@extends('layouts.app')

@section('content')
    <div class="card shadow border-0 rounded-4 p-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold mb-0">Detail Kontrak</h4>
            <a href="{{ route('admin.contract.index') }}" class="btn btn-secondary">
                <i class="ti ti-arrow-left"></i> Kembali
            </a>
        </div>

        <div class="row mb-4">
            <div class="col-md-6 mb-3">
                <label class="text-muted small">Nomor Kontrak</label>
                <div class="fw-semibold">{{ $contract->nomor_kontrak }}</div>
            </div>

            <div class="col-md-6 mb-3">
                <label class="text-muted small">Status</label><br>
                @if ($contract->status == 'menunggu')
                    <span class="badge bg-warning px-3 py-2">Menunggu</span>
                @elseif ($contract->status == 'aktif')
                    <span class="badge bg-success px-3 py-2">Aktif</span>
                @else
                    <span class="badge bg-danger px-3 py-2">Kedaluwarsa</span>
                @endif
            </div>
        </div>

        <hr>

        <div class="row mb-4">

            <div class="col-md-6 mb-3">
                <label class="text-muted small">Client</label>
                <div class="fw-semibold">
                    {{ $contract->client->user->name }} — {{ $contract->client->nama_usaha }}
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <label class="text-muted small">Produk / Layanan</label>
                <div class="fw-semibold">{{ $contract->product->nama_produk }}</div>
            </div>

            <div class="col-md-6 mb-3">
                <label class="text-muted small">Tipe Kontrak</label>
                <div class="fw-semibold">{{ ucfirst($contract->tipe_kontrak) }}</div>
            </div>

            @if ($contract->tipe_kontrak == 'langganan')
                <div class="col-md-6 mb-3">
                    <label class="text-muted small">Periode Tagihan</label>
                    <div class="fw-semibold">{{ ucfirst($contract->periode_tagihan) }}</div>
                </div>
            @endif

        </div>

        <hr>

        <div class="row mb-4">
            <div class="col-md-6 mb-3">
                <label class="text-muted small">Tanggal Mulai</label>
                <div class="fw-semibold">{{ $contract->tanggal_mulai }}</div>
            </div>

            <div class="col-md-6 mb-3">
                <label class="text-muted small">Tanggal Berakhir</label>
                <div class="fw-semibold">{{ $contract->tanggal_berakhir }}</div>
            </div>

            <div class="col-md-6 mb-3">
                <label class="text-muted small">Harga Layanan</label>
                <div class="fw-semibold">
                    Rp {{ number_format($contract->harga_layanan, 0, ',', '.') }}
                </div>
            </div>

            <div class="col-md-6 mb-3">
                <label class="text-muted small">File Kontrak</label><br>
                @if ($contract->file_kontrak)
                    <a href="{{ asset('storage/' . $contract->file_kontrak) }}" target="_blank"
                        class="btn btn-outline-primary btn-sm mt-1">
                        <i class="ti ti-file"></i> Lihat / Download
                    </a>
                @else
                    <span class="text-muted">Belum diupload</span>
                @endif
            </div>
        </div>

        <hr>

        <div class="mb-3">
            <label class="text-muted small">Catatan</label>
            <div class="fw-semibold">
                {!! $contract->catatan ? nl2br(e($contract->catatan)) : '<span class="text-muted">Tidak ada catatan</span>' !!}
            </div>
        </div>

    </div>
@endsection

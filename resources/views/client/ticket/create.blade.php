@extends('layouts.app')

@section('title', 'Buat Tiket Baru')

@section('content')

<div class="card p-4 shadow border-0 rounded-4">

    <h4 class="mb-4 fw-bold">Buat Tiket Baru</h4>

    <form action="{{ route('client.ticket.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label class="fw-semibold">Judul Tiket</label>
            <input type="text" name="judul" class="form-control" required>
        </div>

        {{-- Pilih Kontrak --}}
        <div class="mb-3">
            <label class="fw-semibold">Kontrak Terkait</label>
            <select name="contract_id" class="form-select" required>
                <option value="">-- Pilih Kontrak --</option>
                @foreach ($contracts as $k)
                <option value="{{ $k->id }}">
                    {{ $k->nomor_kontrak }} — {{ $k->product->nama_produk }}
                </option>
                @endforeach
            </select>
        </div>

        {{-- Prioritas --}}
        <div class="mb-3">
            <label class="fw-semibold">Prioritas</label>
            <select name="prioritas" class="form-select" required>
                <option value="rendah">Rendah</option>
                <option value="sedang">Sedang</option>
                <option value="tinggi">Tinggi</option>
                <option value="urgent">Urgent</option>
            </select>
        </div>

        {{-- Deskripsi Masalah --}}
        <div class="mb-3">
            <label class="fw-semibold">Deskripsi Masalah</label>
            <textarea name="deskripsi" class="form-control" rows="4" required></textarea>
        </div>

        {{-- Upload Screenshot / Bukti --}}
        <div class="mb-3">
            <label class="fw-semibold">Lampiran (Opsional)</label>
            <input type="file" name="lampiran" class="form-control" accept="image/*">
            <small class="text-muted">Format: JPG, PNG — Max 2MB</small>
        </div>

        <div class="d-flex justify-content-end gap-2 mt-4">
            <a href="{{ route('client.ticket.index') }}" class="btn btn-light">
                <i class="ti ti-arrow-left"></i> Kembali
            </a>

            <button type="submit" class="btn btn-primary fw-bold">
                <i class="ti ti-device-floppy"></i> Kirim Tiket
            </button>
        </div>

    </form>
</div>

@endsection

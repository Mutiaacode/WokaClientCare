@extends('layouts.app')

@section('content')

<div class="card p-4 shadow">

    <h4 class="mb-4">Edit Kontrak</h4>

    <form action="{{ route('admin.contract.update', $contract->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Client</label>
                <select name="client_id" class="form-control" required>
                    <option value="">-- Pilih Client --</option>
                    @foreach ($clients as $c)
                        <option value="{{ $c->id }}" {{ $contract->client_id == $c->id ? 'selected' : '' }}>
                            {{ $c->user->name }} - {{ $c->nama_usaha }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6 mb-3">
                <label>Produk / Layanan</label>
                <select name="produk_id" class="form-control" required>
                    <option value="">-- Pilih Produk --</option>
                    @foreach ($products as $p)
                        <option value="{{ $p->id }}" {{ $contract->produk_id == $p->id ? 'selected' : '' }}>
                            {{ $p->nama_produk }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>


        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Nomor Kontrak</label>
                <input type="text" name="nomor_kontrak" class="form-control"
                    value="{{ $contract->nomor_kontrak }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Tipe Kontrak</label>
                <select name="tipe_kontrak" id="tipe_kontrak" class="form-control" required>
                    <option value="langganan" {{ $contract->tipe_kontrak == 'langganan' ? 'selected' : '' }}>Langganan</option>
                    <option value="satu_kali" {{ $contract->tipe_kontrak == 'satu_kali' ? 'selected' : '' }}>Satu Kali</option>
                </select>
            </div>
        </div>


        <div class="row" id="periode_tagihan_group" style="{{ $contract->tipe_kontrak == 'satu_kali' ? 'display:none' : '' }}">
            <div class="col-md-6 mb-3">
                <label>Periode Tagihan</label>
                <select name="periode_tagihan" class="form-control">
                    <option value="">-- Pilih Periode --</option>
                    <option value="bulanan" {{ $contract->periode_tagihan == 'bulanan' ? 'selected' : '' }}>Bulanan</option>
                    <option value="tahunan" {{ $contract->periode_tagihan == 'tahunan' ? 'selected' : '' }}>Tahunan</option>
                </select>
            </div>
        </div>


        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Tanggal Mulai</label>
                <input type="date" name="tanggal_mulai" class="form-control"
                    value="{{ $contract->tanggal_mulai }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Tanggal Berakhir</label>
                <input type="date" name="tanggal_berakhir" class="form-control"
                    value="{{ $contract->tanggal_berakhir }}" required>
            </div>
        </div>


        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Harga Layanan</label>
                <input type="number" name="harga_layanan" class="form-control"
                    value="{{ $contract->harga_layanan }}" min="0" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>File Kontrak Baru (PDF/DOC/DOCX)</label>
                <input type="file" name="file_kontrak" class="form-control" accept=".pdf,.doc,.docx">

                @if ($contract->file_kontrak)
                    <a href="{{ asset('storage/' . $contract->file_kontrak) }}" target="_blank" class="d-block mt-2">
                        Lihat File Kontrak Saat Ini
                    </a>
                @endif
            </div>
        </div>


        <div class="mb-3">
            <label>Catatan</label>
            <textarea name="catatan" class="form-control" rows="3">{{ $contract->catatan }}</textarea>
        </div>


        <div class="d-flex justify-content-end gap-2 mt-3">
            <a href="{{ route('admin.contract.index') }}" class="btn btn-light">
                <i class="ti ti-arrow-left"></i> Kembali
            </a>

            <button class="btn btn-primary">
                <i class="ti ti-device-floppy"></i> Simpan Perubahan
            </button>
        </div>

    </form>
</div>

<script>
    const tipeKontrak = document.getElementById('tipe_kontrak');
    const periodeGroup = document.getElementById('periode_tagihan_group');

    tipeKontrak.addEventListener('change', function () {
        periodeGroup.style.display = this.value === 'satu_kali' ? 'none' : 'block';
    });
</script>

@endsection

@extends('layouts.app')

@section('content')

<div class="card shadow border-0 rounded-4 p-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">Detail Jadwal Maintenance</h4>
        <a href="{{ route('teknisi.maintenance.index') }}" class="btn btn-secondary">
            <i class="ti ti-arrow-left"></i> Kembali
        </a>
    </div>

    <div class="row g-3">

        {{-- CONTRACT --}}
        <div class="col-12">
            <label class="fw-semibold">Contract</label>
            <div class="border rounded px-3 py-2 bg-light">
                {{ $maintenance->contract->nomor_kontrak ?? $maintenance->contract_id }}
            </div>
        </div>

        {{-- TEKNISI --}}
        <div class="col-12">
            <label class="fw-semibold">Teknisi</label>
            <div class="border rounded px-3 py-2 bg-light">
                {{ $maintenance->teknisi->name ?? $maintenance->teknisi_id }}
            </div>
        </div>

        {{-- TANGGAL KUNJUNGAN --}}
        <div class="col-12">
            <label class="fw-semibold">Tanggal Kunjungan</label>
            <div class="border rounded px-3 py-2 bg-light">
                {{ \Carbon\Carbon::parse($maintenance->tanggal_kunjungan)->format('d-m-Y') }}
            </div>
        </div>

        {{-- JAM KUNJUNGAN --}}
        <div class="col-12">
            <label class="fw-semibold">Jam Kunjungan</label>
            <div class="border rounded px-3 py-2 bg-light">
                {{ $maintenance->jam_kunjungan }}
            </div>
        </div>

        {{-- STATUS --}}
        <div class="col-12">
            <label class="fw-semibold">Status</label>
            <div class="border rounded px-3 py-2 bg-light text-uppercase">
                {{ $maintenance->status }}
            </div>
        </div>
        <form action="{{ route('teknisi.maintenance.update', $maintenance->id) }}" method="post">
            @csrf @method('PUT')
             <div class="col-12">
            <label class="fw-semibold mb-2">Catatan</label>

            <div class="d-flex gap-2">
                <input type="text"
                    name="catatan"
                    class="border rounded px-3 py-2 bg-light form-control"
                    placeholder="Tulis catatan teknisi di sini...">

                <button class="btn btn-primary px-4">
                    Simpan
                </button>
            </div>
        </div>
        </form>
    </div>
</div>

@endsection
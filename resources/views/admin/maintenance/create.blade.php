@extends('layouts.app')

@section('title', 'Tambah Maintenance - Admin')

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="card p-4 shadow">

        <h4 class="mb-4 fw-bold">Jadwalkan Maintenance</h4>

        <form action="{{ route('admin.maintenance.store') }}" method="POST">
            @csrf

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Kontrak</label>
                    <select name="contract_id" class="form-control" required>
                        <option value="">-- Pilih Kontrak --</option>
                        @foreach ($contracts as $c)
                            <option value="{{ $c->id }}">
                                {{ $c->nomor_kontrak }} - {{ $c->client->user->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Teknisi</label>
                    <select name="teknisi_id" class="form-control" required>
                        <option value="">-- Pilih Teknisi --</option>
                        @foreach ($teknisi as $t)
                            <option value="{{ $t->id }}">{{ $t->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Tanggal Kunjungan</label>
                    <input type="date" name="tanggal_kunjungan" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Jam Kunjungan</label>
                    <input type="time" name="jam_kunjungan" class="form-control" required>
                </div>
            </div>

            <div class="mb-3">
                <label>Catatan</label>
                <textarea name="catatan" class="form-control" rows="3"></textarea>
            </div>

            <div class="d-flex justify-content-end gap-2 mt-3">
                <a href="{{ route('admin.maintenance.index') }}" class="btn btn-light">
                    <i class="ti ti-arrow-left"></i> Kembali
                </a>

                <button class="btn btn-primary">
                    <i class="ti ti-device-floppy"></i> Simpan
                </button>
            </div>
        </form>
    </div>
@endsection

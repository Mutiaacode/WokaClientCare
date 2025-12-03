@extends('layouts.app')

@section('title', 'Edit Maintenance - Admin') 

@section('content')
    <div class="card p-4 shadow">
        <h4 class="mb-4 fw-bold">Edit Jadwal Maintenance</h4>

        <h4 class="mb-4">Buat Invoice</h4>

        <form action="{{ route('admin.maintenance.store', $maintenance->id) }}" method="PUT">
            @csrf
            <div class="mb-3">
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
            <div class="mb-3">
                <label>teknisi</label>
                <select name="teknisi_id" class="form-control" required>
                    <option value="">-- Pilih Teknisi --</option>
                    @foreach ($teknisi as $t)
                        <option value="{{ $t->id }}">
                            {{ $t->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label class="fw-semibold">Tanggal Kunjungan</label>
                <input type="date" name="tanggal_kunjungan" class="form-control" required>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Tanggal Kunjungan</label>
                    <input type="date" name="tanggal_kunjungan" class="form-control"
                        value="{{ $maintenance->tanggal_kunjungan }}" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Jam Kunjungan</label>
                    <input type="time" name="jam_kunjungan" class="form-control"
                        value="{{ $maintenance->jam_kunjungan }}" required>
                </div>
            </div>

            <div class="mb-3">
                <label>Catatan</label>
                <textarea name="catatan" class="form-control" rows="3">{{ $maintenance->catatan }}</textarea>
            </div>

            <div class="d-flex justify-content-end gap-2 mt-3">
                <a href="{{ route('admin.maintenance.index') }}" class="btn btn-light">
                    <i class="ti ti-arrow-left"></i> Kembali
                </a>

                <button class="btn btn-primary">
                    <i class="ti ti-device-floppy"></i> Update
                </button>
            </div>

        </form>
    </div>
@endsection

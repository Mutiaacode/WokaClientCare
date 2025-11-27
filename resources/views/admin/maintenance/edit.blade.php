@extends('layouts.app')

@section('content')
    <div class="card p-4 shadow">

        <h4 class="mb-4">Buat Invoice</h4>

        <form action="{{ route('admin.maintenance.update') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label class="fw-semibold">Tanggal Kunjungan</label>
                <input type="date" name="tanggal_kunjungan" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="fw-semibold">jam Kunjungan</label>
                <input type="time" name="jam_kunjungan" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="fw-semibold">Status</label>
                <select name="status" class="form-control border rounded px-3 py-2 bg-light" required>
                    <option value="dijadwalkan">Di Jadwalkan</option>
                    <option value="selesai">Selesai</option>
                    <option value="dibatalkan">Di Batalkan</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="fw-semibold">Catatan</label>
                <input type="text" name="catatan" class="form-control" required>
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
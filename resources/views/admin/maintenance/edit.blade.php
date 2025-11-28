@extends('layouts.app')

@section('content')
    <div class="card p-4 shadow">
        <h4 class="mb-4 fw-bold">Edit Jadwal Maintenance</h4>

        <form action="{{ route('admin.maintenance.update', $maintenance->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Teknisi</label>
                    <select name="teknisi_id" class="form-control" required>
                        @foreach ($teknisi as $t)
                            <option value="{{ $t->id }}" {{ $maintenance->teknisi_id == $t->id ? 'selected' : '' }}>
                                {{ $t->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Status</label>
                    <select name="status" class="form-control" required>
                        <option value="dijadwalkan" {{ $maintenance->status == 'dijadwalkan' ? 'selected' : '' }}>
                            Dijadwalkan</option>
                        <option value="selesai" {{ $maintenance->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                        <option value="dibatalkan" {{ $maintenance->status == 'dibatalkan' ? 'selected' : '' }}>Dibatalkan
                        </option>
                    </select>
                </div>
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

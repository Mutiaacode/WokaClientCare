@extends('layouts.app')

@section('content')
    @if (session('sukses'))
        <div class="alert alert-success mt-3 px-4">{{ session('sukses') }}</div>
    @endif

    <div class="card shadow border-0 rounded-3">
        <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white py-3 rounded-top">
            <h4 class="mb-0 text-white">Data Maintenance</h4>
            <a href="{{ route('admin.maintenance.create') }}" class="btn btn-light fw-bold">+ Buat Maintenance</a>
        </div>

        <div class="table-responsive p-3">
            <table class="table table-hover table-bordered align-middle mb-0">
                <thead class="table-primary text-center">
                    <tr>
                        <td>Contdact</td>
                        <td>Nama Teknisi</td>
                        <td>Status</td>
                        <td>Catatan</td>
                        <td>Aksi</td>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($maintenances as $m)
                        <tr>
                            <td class="text-center">{{ $m->contract->nomor_kontrak }}</td>
                            <td class="text-center">{{ $m->teknisi->name }}</td>
                            <td class="text-center">{{ $m->status }}</td>
                            <td class="text-center">{{ $m->catatan }}</td>

                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('admin.maintenance.edit', $m->id) }}"
                                        class="btn btn-info btn-sm text-white">Edit</a>
                                    <form action="" method="POST">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus data ini?')">
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>

                        </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
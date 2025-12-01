@extends('layouts.app')

@section('content')

    @if (session('sukses'))
        <div class="alert alert-success mt-3 px-4">{{ session('sukses') }}</div>
    @endif

    <div class="card shadow border-0 rounded-3">
        <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white py-3 rounded-top">
            <h4 class="mb-0 text-white">Data Maintenance</h4>
        </div>

        <div class="table-responsive p-3">
            <table class="table table-hover table-bordered align-middle mb-0">
                <thead class="table-primary text-center">
                    <tr>
                        <th>No</th>
                        <th>Client</th>
                        <th>Contract</th>
                        <th>status</th>
                        <th>Teknisi</th>
                        <th>Catatan</th>
                        <th width="180px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($maintenance as $m)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $m->contract->client->user->name }}</td>
                            <td>{{ $m->contract->nomor_kontrak }}</td>
                            <td>{{ $m->status }}</td>
                            <td>{{ $m->teknisi->name }}</td>
                            <td>{{ $m->catatan }}</td>
                            <td class="text-center">
                                <a href="{{ route('teknisi.maintenance.show', $m->id) }}"
                                    class="btn btn-sm btn-info text-white">Detail</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
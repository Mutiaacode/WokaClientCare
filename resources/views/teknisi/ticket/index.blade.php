@extends('layouts.app')

@section('content')

    @if (session('sukses'))
        <div class="alert alert-success mt-3 px-4">{{ session('sukses') }}</div>
    @endif

    <div class="card shadow border-0 rounded-3">
        <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white py-3 rounded-top">
            <h4 class="mb-0 text-white">Data Ticket</h4>
        </div>

        <div class="table-responsive p-3">
            <table class="table table-hover table-bordered align-middle mb-0">
                <thead class="table-primary text-center">
                    <tr>
                        <th>No</th>
                        <th>Client</th>
                        <th>Contract</th>
                        <th>Staf</th>
                        <th>Teknisi</th>
                        <th>Prioritas</th>
                        <th>Status</th>
                        <th width="180px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tickets as $ticket)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $ticket->contract->client->name }}</td>
                            <td>{{ $ticket->contract->nomor_kontrak }}</td>
                            <td>{{ $ticket->staf->name }}</td>
                            <td>{{ $ticket->teknisi->name }}</td>
                            <td class="text-center">{{ $ticket->prioritas }}</td>
                            <td class="text-center">{{ $ticket->status }}</td>
                            <td class="text-center">
                                <a href="{{ route('teknisi.ticket.show', $ticket->id) }}"
                                    class="btn btn-sm btn-info text-white">Detail</a>
                            </td>
                        </tr>
                    @endforeach
            </table>
        </div>
    </div>
@endsection
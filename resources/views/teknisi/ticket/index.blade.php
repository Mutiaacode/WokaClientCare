@extends('layouts.app')

@section('content')

    @if (session('sukses'))
        <div class="alert alert-success mt-3 px-4">{{ session('sukses') }}</div>
    @endif

    <div class="card shadow border-0 rounded-3">
        <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white py-3 rounded-top">
            <h4 class="mb-0 text-white">Data Ticket</h4>

            <form action="{{ route('teknisi.ticket.search') }}" method="GET" class="d-flex">
                <input type="text" name="search" class="form-control me-2 btn btn-light" placeholder="Cari ticket..."
                    value="{{ request('search') }}">
                <button class="btn btn-light">Search</button>
            </form>
        </div>

        @if (request('search'))
            <div class="px-3 pt-3">
                <p class="mb-2">
                    Hasil pencarian untuk: <strong>"{{ request('search') }}"</strong>
                </p>
                @if($tickets->count() === 0)
                    <p class="text-danger">Tidak ada data ditemukan.</p>
                @endif
            </div>
        @endif

        <div class="table-responsive p-3">
            <table class="table table-hover table-bordered align-middle mb-0">
                <thead class="table-primary text-center">
                    <tr>
                        <th>No</th>
                        <th>Client</th>
                        <th>Contract</th>
                        <th>Status</th>
                        <th width="180px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tickets as $ticket)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $ticket->client->user->name }}</td>
                            <td class="text-center">{{ $ticket->contract->nomor_kontrak }}</td>
                            <td class="text-center">{{ $ticket->status }}</td>
                            <td class="text-center">
                                <a href="{{ route('teknisi.ticket.show', $ticket->id) }}"
                                    class="btn btn-sm btn-info text-white">Detail</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
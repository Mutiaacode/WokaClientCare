@extends('layouts.app')

@section('title', 'Dashboard Tiket - Teknisi')

@section('content')

@if (session('sukses'))
    <div class="alert alert-success mt-3 px-4">
        {{ session('sukses') }}
    </div>
@endif

{{-- FILTER --}}
<div class="mb-3 d-flex align-items-center gap-2">

    <form action="{{ route('teknisi.ticket.index') }}" method="GET" class="d-flex gap-2">
        <select name="status" class="form-select">
            <option value="">-- Semua Status --</option>
            <option value="Open" {{ request('status') == 'Open' ? 'selected' : '' }}>Open</option>
            <option value="In Progress" {{ request('status') == 'In Progress' ? 'selected' : '' }}>In Progress</option>
            <option value="Waiting Tech" {{ request('status') == 'Waiting Tech' ? 'selected' : '' }}>Waiting Tech</option>
            <option value="Resolved" {{ request('status') == 'Resolved' ? 'selected' : '' }}>Resolved</option>
            <option value="Closed" {{ request('status') == 'Closed' ? 'selected' : '' }}>Closed</option>
        </select>

        <button class="btn btn-woka">
            Filter
        </button>
    </form>

    @if(request('status'))
        <a href="{{ route('teknisi.ticket.index') }}" class="btn btn-warning">
            Reset
        </a>
    @endif

</div>

{{-- CARD --}}
<div class="card shadow border-0 rounded-3">
    <div
        class="card-header d-flex justify-content-between align-items-center bg-primary text-white py-4 rounded-top">
        <h4 class="mb-0 text-white">Data Tiket Teknisi</h4>
    </div>

    <div class="table-responsive p-3">
        <table class="table table-hover table-bordered align-middle mb-0">
            <thead class="table-primary text-center">
                <tr>
                    <th>No</th>
                    <th>Client</th>
                    <th>Contract</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th width="150px">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($tickets as $ticket)
                    <tr>
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>{{ $ticket->client->user->name }}</td>
                        <td class="text-center">{{ $ticket->contract->nomor_kontrak }}</td>
                        <td class="text-center">
                            <span class="badge bg-info text-dark">
                                {{ $ticket->status }}
                            </span>
                        </td>
                        <td class="text-center">
                            {{ $ticket->created_at->format('d-m-Y') }}
                        </td>
                        <td class="text-center">
                            <a href="{{ route('teknisi.ticket.show', $ticket->id) }}"
                               class="btn btn-info btn-sm text-white">
                                Detail
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-danger">
                            Tidak ada tiket ditemukan.
                        </td>
                    </tr>
                @endforelse
            </tbody>

        </table>
    </div>
</div>

@endsection

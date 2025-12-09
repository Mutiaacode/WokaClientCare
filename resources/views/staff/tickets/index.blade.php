@extends('layouts.app')

@section('content')

    @if (session('sukses'))
        <div class="alert alert-success mt-3 px-4">{{ session('sukses') }}</div>
    @endif

    <div class="card shadow border-0 rounded-3">
        <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white py-3 rounded-top">
            <h4 class="mb-0 text-white">Data Ticket</h4>

            <form action="{{ route('staff.tickets.index') }}" method="GET" class="d-flex gap-2">
                <select name="status" class="form-select bg-light">
                    <option value="">-- Semua Status --</option>
                    <option value="open" {{ request('status') == 'open' ? 'selected' : '' }}>Open</option>
                    <option value="in_progress" {{ request('status') == 'in_progress' ? 'selected' : '' }}>In Progress
                    </option>
                    <option value="waiting_tech" {{ request('status') == 'waiting_tech' ? 'selected' : '' }}>Waiting Tech
                    </option>
                    <option value="resolved" {{ request('status') == 'resolved' ? 'selected' : '' }}>Resolved</option>
                    <option value="closed" {{ request('status') == 'closed' ? 'selected' : '' }}>Closed</option>
                </select>

                <button class="btn btn-light">Filter</button>
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
                        <th>No Contract</th>
                        <th>Status</th>
                        <th width="180px">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tickets as $ticket)
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $ticket->client->user->name }}</td>
                            <td class="text-center">{{ $ticket->contract->nomor_kontrak }}</td>
                            <td class="text-center">
                                @if ($ticket->status == 'open')
                                    <span class="badge bg-secondary">Open</span>
                                @elseif ($ticket->status == 'in_progress')
                                    <span class="badge bg-info">In Progress</span>
                                @elseif ($ticket->status == 'resolved')
                                    <span class="badge bg-success">Resolved</span>
                                @else
                                    <span class="badge bg-dark">Closed</span>
                                @endif
                            </td>
                            <td class="text-center">
                                <a href="{{ route('staff.tickets.show', $ticket->id) }}"
                                    class="btn btn-sm btn-info text-white">Detail</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Tidak ada data ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>
@endsection
@extends('layouts.app')

@section('title', 'Tiket Saya')

@section('content')
    <div class="card shadow border-0 rounded-3">
        <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white py-3 rounded-top">
            <h4 class="mb-0 text-white">Ticket Saya</h4>

            <form action="{{ route('client.ticket.index') }}" method="GET" class="d-flex align-items-center"
                style="gap: 15px;">

                <div class="input-group" style="width: 280px;">

                    <button class="input-group-text border-end-0">
                        <i class="ti ti-search text-muted"></i>
                    </button>

                    <input type="text" name="search" class="form-control border-start-0"
                        placeholder="Cari nomor kontrak / judul" value="{{ request('search') }}"
                        style="background-color: white; color: #333;">
                </div>

                <a href="{{ route('client.ticket.create') }}" class="btn btn-light fw-semibold px-4 py-2 rounded">
                    + Buat Tiket
                </a>

            </form>

        </div>

        @if(request('search'))
            <div class="gap-2 px-3 pt-3">
                <p class="mb-1">Hasil pencarian untuk: "<strong>{{ request('search') }}</strong>"</p>

                @if($tickets->count() === 0)
                    <p class="text-danger mb-0">Tidak ada data ditemukan.</p>
                @endif
            </div>
        @endif

        <div class="table-responsive p-3">
            <table class="table table-hover table-bordered align-middle mb-0">
                <thead class="table-primary text-center">
                    <tr>
                        <th>Judul</th>
                        <th>Prioritas</th>
                        <th>Status</th>
                        <th>Kontrak</th>
                        <th width="130px">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($tickets as $t)
                        <tr>
                            <td>{{ $t->judul }}</td>

                            <td class="text-center">
                                <span class="badge
                                                                                                    @if($t->prioritas == 'rendah') bg-secondary
                                                                                                    @elseif($t->prioritas == 'sedang') bg-info
                                                                                                    @elseif($t->prioritas == 'tinggi') bg-warning text-dark
                                                                                                    @else bg-danger
                                                                                                    @endif">
                                    {{ ucfirst($t->prioritas) }}
                                </span>
                            </td>

                            <td class="text-center">
                                <span class="badge
                                                                                                    @if($t->status == 'open') bg-secondary
                                                                                                    @elseif($t->status == 'in_progress') bg-info
                                                                                                    @elseif($t->status == 'resolved') bg-success
                                                                                                    @else bg-dark
                                                                                                    @endif">
                                    {{ ucfirst(str_replace('_', ' ', $t->status)) }}
                                </span>
                            </td>

                            <td>
                                {{ $t->contract->nomor_kontrak ?? '-' }}
                            </td>

                            <td class="text-center">
                                <a href="{{ route('client.ticket.show', $t->id) }}" class="btn btn-info btn-sm text-white">
                                    Detail
                                </a>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">
                                Belum ada tiket.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>
@endsection
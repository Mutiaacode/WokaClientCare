@extends('layouts.app')

@section('title', 'Tiket Saya')

@section('content')
<div class="card shadow border-0 rounded-3">
    <div class="card-header bg-primary text-white py-3 rounded-top d-flex justify-content-between align-items-center">
        <h4 class="mb-0 text-white">Tiket Saya</h4>
        <a href="{{ route('client.ticket.create') }}" class="btn btn-light fw-semibold">
            + Buat Tiket
        </a>
    </div>

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
                        <a href="{{ route('client.ticket.show', $t->id) }}" 
                           class="btn btn-info btn-sm text-white">
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

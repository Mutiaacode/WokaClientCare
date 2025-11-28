@extends('layouts.app')

@section('title', 'Maintenance Saya')

@section('content')

<div class="card shadow border-0 rounded-3">
    <div class="card-header bg-primary text-white py-3 rounded-top">
        <h4 class="mb-0 text-white">Maintenance Saya</h4>
    </div>

    <div class="table-responsive p-3">
        <table class="table table-hover table-bordered align-middle mb-0">
            <thead class="table-primary text-center">
                <tr>
                    <th>Kontrak</th>
                    <th>Teknisi</th>
                    <th>Tanggal kunjungan</th>
                    <th>Jam Kunjungan</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($maintenances as $m)
                <tr>
                    <td class="text-center">
                        {{ $m->contract->nomor_kontrak }}
                    </td>

                    <td class="text-center">
                        {{ $m->teknisi->name ?? 'Belum ditentukan' }}
                    </td>

                    <td class="text-center">
    {{ $m->tanggal_kunjungan ? date('d-m-Y', strtotime($m->tanggal_kunjungan)) : '-' }}
</td>

<td class="text-center">
    {{ $m->jam_kunjungan ? date('H:i', strtotime($m->jam_kunjungan)) : '-' }}
</td>


                    <td class="text-center">
                        <span class="badge 
                            @if ($m->status == 'scheduled') bg-info
                            @elseif ($m->status == 'in_progress') bg-warning text-dark
                            @elseif ($m->status == 'completed') bg-success
                            @else bg-secondary
                            @endif">
                            {{ ucfirst(str_replace('_', ' ', $m->status)) }}
                        </span>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center text-muted py-3">
                        Tidak ada data maintenance.
                    </td>
                </tr>
                @endforelse
            </tbody>

        </table>
    </div>
</div>

@endsection

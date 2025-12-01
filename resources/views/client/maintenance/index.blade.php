@extends('layouts.app')

@section('title', 'Maintenance Saya')

@section('content')

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

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
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

            <tbody>
                @forelse ($maintenances as $m)
                <tr>

                    <td class="text-center">{{ $m->contract->nomor_kontrak }}</td>

                    <td class="text-center">{{ $m->teknisi->name ?? 'Belum ditentukan' }}</td>

                    <td class="text-center">
                        {{ $m->tanggal_kunjungan ? date('d-m-Y', strtotime($m->tanggal_kunjungan)) : '-' }}
                    </td>

                    <td class="text-center">
                        {{ $m->jam_kunjungan ? date('H:i', strtotime($m->jam_kunjungan)) : '-' }}
                    </td>

                    {{-- STATUS --}}
                    <td class="text-center">
                        <span class="badge 
                            @if ($m->status == 'dijadwalkan') bg-info
                            @elseif ($m->status == 'selesai') bg-success
                            @elseif ($m->status == 'dibatalkan') bg-danger
                            @else bg-secondary
                            @endif
                        ">
                            {{ ucfirst($m->status) }}
                        </span>
                    </td>

                    {{-- Aksi --}}
                    {{-- Aksi --}}
<td class="text-center">

    @if ($m->client_has_acted)
        {{-- Sudah memilih -> hanya tampilkan detail --}}
        <a href="#" class="btn btn-info btn-sm text-white">Detail</a>

    @else

        @if ($m->status == 'selesai')
            <div class="d-flex justify-content-center gap-2">

                {{-- Terima --}}
                <form action="{{ route('client.maintenance.accept', $m->id) }}" method="POST">
                    @csrf
                    <button class="btn btn-success btn-sm">
                        Terima
                    </button>
                </form>

                {{-- Tolak --}}
                <form action="{{ route('client.maintenance.reject', $m->id) }}" method="POST">
                    @csrf
                    <button class="btn btn-danger btn-sm">
                        Tolak
                    </button>
                </form>

                {{-- Detail --}}
                <a href="#" class="btn btn-info btn-sm text-white">Detail</a>

            </div>
        @else
            <a href="#" class="btn btn-info btn-sm text-white">Detail</a>
        @endif

    @endif

</td>


                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center text-muted py-3">
                        Tidak ada data maintenance.
                    </td>
                </tr>
                @endforelse
            </tbody>

        </table>
    </div>
</div>

@endsection

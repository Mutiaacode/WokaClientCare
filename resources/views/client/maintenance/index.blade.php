@extends('layouts.app')

@section('title', 'Maintenance Saya')

@section('content')

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow border-0 rounded-3">
        <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white py-3 rounded-top">
            <h4 class="mb-0 text-white">Maintenance Saya</h4>

             <form action="{{ route('client.maintenance.index') }}" method="GET" class="d-flex align-items-center"
                style="gap: 15px;">

                <div class="input-group" style="width: 280px;">

                    <button class="input-group-text border-end-0">
                        <i class="ti ti-search text-muted"></i>
                    </button>

                    <input type="text" name="search" class="form-control border-start-0"
                        placeholder="Cari nomor kontrak / judul" value="{{ request('search') }}"
                        style="background-color: white; color: #333;">
                </div>

            </form>
        </div>

        @if(request('search'))
            <div class="gap-2 px-3 pt-3">
                <p class="mb-1">Hasil pencarian untuk: "<strong>{{ request('search') }}</strong>"</p>

                @if($maintenances->count() === 0)
                    <p class="text-danger mb-0">Tidak ada data ditemukan.</p>
                @endif
            </div>
        @endif

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
                                {{ $m->tanggal_kunjungan ? date('d-m-Y', strtotime($m->tanggal_kunjungan)) : '-' }}</td>
                            <td class="text-center">{{ $m->jam_kunjungan ? date('H:i', strtotime($m->jam_kunjungan)) : '-' }}
                            </td>
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
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    @if (!$m->client_has_acted && $m->status == 'dijadwalkan')
                                        <form action="{{ route('client.maintenance.accept', $m->id) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-success btn-sm">Terima</button>
                                        </form>
                                        <form action="{{ route('client.maintenance.reject', $m->id) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-danger btn-sm">Tolak</button>
                                        </form>
                                    @endif
                                    <button class="btn btn-info btn-sm text-white" data-bs-toggle="modal"
                                        data-bs-target="#detailModal-{{ $m->id }}">
                                        Detail
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-3">Tidak ada data maintenance.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- MODAL DETAIL PER-MAINTENANCE --}}
    @foreach ($maintenances as $m)
        <div class="modal fade" id="detailModal-{{ $m->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content shadow-lg rounded-4">

                    {{-- HEADER SOLID --}}
                    <div class="modal-header bg-primary text-white p-3 border-bottom-0">
                        <h5 class="modal-title">
                            <i class="bi bi-info-circle me-2"></i>Detail Maintenance
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                    </div>

                    {{-- BODY --}}
                    <div class="modal-body p-4">
                        <table class="table table-borderless mb-0">
                            <tr>
                                <th style="width: 35%">Nomor Kontrak</th>
                                <td>{{ $m->contract->nomor_kontrak }}</td>
                            </tr>
                            <tr>
                                <th>Teknisi</th>
                                <td>{{ $m->teknisi->name ?? 'Belum ditentukan' }}</td>
                            </tr>
                            <tr>
                                <th>Tanggal Kunjungan</th>
                                <td>{{ $m->tanggal_kunjungan ? date('d-m-Y', strtotime($m->tanggal_kunjungan)) : '-' }}</td>
                            </tr>
                            <tr>
                                <th>Jam Kunjungan</th>
                                <td>{{ $m->jam_kunjungan ? date('H:i', strtotime($m->jam_kunjungan)) : '-' }}</td>
                            </tr>
                            <tr>
                                <th>Status</th>
                                <td>
                                    <span class="badge 
                                        @if ($m->status == 'dijadwalkan') bg-info
                                        @elseif ($m->status == 'selesai') bg-success
                                        @elseif ($m->status == 'dibatalkan') bg-danger
                                        @else bg-secondary
                                        @endif
                                        py-2 px-3 fs-6">
                                        {{ ucfirst($m->status) }}
                                    </span>
                                </td>
                            </tr>
                            <tr>
                                <th>Catatan</th>
                                <td>{{ $m->catatan ?? '-' }}</td>
                            </tr>
                        </table>
                    </div>

                    {{-- FOOTER --}}
                    <div class="modal-footer border-0 justify-content-end">
                        <button class="btn btn-secondary btn-lg rounded-pill px-4" data-bs-dismiss="modal">Tutup</button>
                    </div>

                </div>
            </div>
        </div>
    @endforeach

@endsection
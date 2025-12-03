@extends('layouts.app')

@section('title', 'Detail Maintenance - Admin') 

@section('content')

<div class="card shadow-sm border-0 rounded-3 p-4">

    <h4 class="fw-bold mb-4">Detail Maintenance</h4>

    <div class="mb-3">
        <strong>Kontrak:</strong> {{ $maintenance->contract->nomor_kontrak }}
    </div>

    <div class="mb-3">
        <strong>Client:</strong> 
        {{ $maintenance->contract->client->user->name }}
    </div>

    <div class="mb-3">
        <strong>Teknisi:</strong> 
        {{ $maintenance->teknisi->name }}
    </div>

    <div class="mb-3">
        <strong>Tanggal Kunjungan:</strong> 
        {{ $maintenance->tanggal_kunjungan }}
    </div>

    <div class="mb-3">
        <strong>Jam Kunjungan:</strong> 
        {{ $maintenance->jam_kunjungan }}
    </div>

    <div class="mb-3">
        <strong>Status:</strong>
        @if($maintenance->status == 'dijadwalkan')
            <span class="badge bg-warning text-dark">Dijadwalkan</span>
        @elseif($maintenance->status == 'selesai')
            <span class="badge bg-success">Selesai</span>
        @else
            <span class="badge bg-danger">Dibatalkan</span>
        @endif
    </div>

    <div class="mb-3">
        <strong>Catatan:</strong><br>
        {!! nl2br(e($maintenance->catatan)) !!}
    </div>

    <div class="d-flex justify-content-end">
        <a href="{{ route('admin.maintenance.index') }}" class="btn btn-secondary">
            <i class="ti ti-arrow-left"></i> Kembali
        </a>
    </div>

</div>

@endsection
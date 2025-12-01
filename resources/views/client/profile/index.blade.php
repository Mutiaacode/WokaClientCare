@extends('layouts.app')

@section('title', 'Profil Saya')

@section('content')

@if(session('success'))
    <div class="alert alert-success mt-3">{{ session('success') }}</div>
@endif

<div class="card shadow border-0 rounded-3">
    <div class="card-header bg-primary text-white py-3 rounded-top">
        <h4 class="mb-0 text-white">Profil Saya</h4>
    </div>

    <div class="card-body px-4 py-4">

        <h5 class="fw-bold">Data Akun</h5>

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Nama</label>
                <input type="text" class="form-control" value="{{ $user->name }}" disabled>
            </div>

            <div class="col-md-6">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" value="{{ $user->email }}" disabled>
            </div>
        </div>

        <hr>

        <h5 class="fw-bold">Data Client</h5>

        <div class="row mb-3">
            <div class="col-md-6">
                <label class="form-label">Nama Usaha</label>
                <input type="text" class="form-control" value="{{ $client->nama_usaha }}" disabled>
            </div>

            <div class="col-md-6">
                <label class="form-label">Nomor HP</label>
                <input type="text" class="form-control" value="{{ $client->nomor_hp }}" disabled>
            </div>
        </div>

        <div class="mb-3">
            <label class="form-label">Alamat</label>
            <textarea class="form-control" rows="3" disabled>{{ $client->alamat }}</textarea>
        </div>

        <div class="text-end">
            <a href="{{ route('client.profile.edit') }}" class="btn btn-primary">
                Edit Profil
            </a>
        </div>

    </div>
</div>

@endsection

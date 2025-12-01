@extends('layouts.app')

@section('title', 'Edit Profil')

@section('content')

@if(session('success'))
    <div class="alert alert-success mt-3">{{ session('success') }}</div>
@endif

<div class="card shadow border-0 rounded-3">
    <div class="card-header bg-primary text-white py-3 rounded-top">
        <h4 class="mb-0">Edit Profil</h4>
    </div>

    <div class="card-body px-4 py-4">

        {{-- FORM UPDATE DATA --}}
        <form action="{{ route('client.profile.update') }}" method="POST">
            @csrf

            <h5 class="fw-bold">Data Akun</h5>
            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Nama</label>
                    <input type="text" name="name" class="form-control"
                           value="{{ $user->name }}" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control"
                           value="{{ $user->email }}" required>
                </div>
            </div>

            <hr>

            <h5 class="fw-bold">Data Client</h5>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Nama Usaha</label>
                    <input type="text" name="nama_usaha" class="form-control"
                           value="{{ $client->nama_usaha }}" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Nomor HP</label>
                    <input type="text" name="nomor_hp" class="form-control"
                           value="{{ $client->nomor_hp }}">
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Alamat</label>
                <textarea name="alamat" class="form-control" rows="3">{{ $client->alamat }}</textarea>
            </div>

            <div class="text-end mb-4">
                <button class="btn btn-success">Simpan Perubahan</button>
            </div>
        </form>

        {{-- FORM OPSIONAL GANTI PASSWORD --}}
        <hr>

        <form action="{{ route('client.profile.password') }}" method="POST">
            @csrf

            <h5 class="fw-bold">Ganti Password (Opsional)</h5>

            <div class="mb-3">
                <label class="form-label">Password Baru</label>
                <input type="password" name="password" class="form-control">
            </div>

            <div class="mb-3">
                <label class="form-label">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control">
            </div>

            <div class="text-end">
                <button class="btn btn-warning">Update Password</button>
            </div>

        </form>

    </div>
</div>

@endsection

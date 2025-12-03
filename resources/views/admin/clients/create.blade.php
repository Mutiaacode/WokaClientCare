@extends('layouts.app')

@section('title', 'Tambah Client - Admin') 

@section('content')
    <div class="card shadow border-0 rounded-2 p-4">

        <div class="mb-4">
            <p class="text-muted mb-0" style="font-size: 14px;">
                Isi informasi untuk menambahkan client baru.
            </p>
        </div>

        <form action="{{ route('admin.clients.store') }}" method="POST">
            @csrf
            <div class="row g-3 mb-4">
                <div class="col-md-6">
                    <label class="form-label fw-medium">Nama</label>
                    <input type="text" name="name" class="form-control form-control-lg rounded-2">
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-medium">Email</label>
                    <input type="email" name="email" class="form-control form-control-lg rounded-2">
                </div>

                <div class="col-12">
                    <label class="form-label fw-medium">Password</label>
                    <input type="password" name="password" class="form-control form-control-lg rounded-2">
                </div>
            </div>
            <hr class="my-4">
            <div class="row g-3 mb-3">
                <div class="col-md-6">
                    <label class="form-label fw-medium">Nama Usaha</label>
                    <input type="text" name="nama_usaha" class="form-control form-control-lg rounded-2">
                </div>

                <div class="col-md-6">
                    <label class="form-label fw-medium">Nomor HP</label>
                    <input type="text" name="nomor_hp" class="form-control form-control-lg rounded-2">
                </div>

                <div class="col-12">
                    <label class="form-label fw-medium">Alamat</label>
                    <textarea name="alamat" class="form-control form-control-lg rounded-2" rows="3"></textarea>
                </div>
            </div>

            <div class="d-flex justify-content-end gap-2 mt-4">
                <a href="{{ route('admin.clients.index') }}"
                    class="btn btn-light border rounded-2 px-4 py-2 d-flex align-items-center">
                    <i class="ti ti-arrow-left fs-5 me-2"></i> Kembali
                </a>

                <button class="btn btn-primary rounded-2 px-4 py-2 fw-semibold d-flex align-items-center">
                    <i class="ti ti-device-floppy fs-5 me-2"></i> Simpan
                </button>
            </div>

        </form>

    </div>
@endsection

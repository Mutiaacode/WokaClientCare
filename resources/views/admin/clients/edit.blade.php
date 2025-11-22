@extends('layouts.app')

@section('page-title', 'Edit Client')
@section('breadcrumb', 'Edit Client')

@section('content')
    <div class="card shadow-sm border-0 p-4 rounded-3">

        <div class="mb-4">
            <p class="text-muted mb-0" style="font-size: 14px;">
                Perbarui informasi akun dan data client dengan tampilan lebih bersih & modern.
            </p>
        </div>

        <form action="{{ route('admin.clients.update', $client->id) }}" method="POST">
            @csrf @method('PUT')

            <div class="mb-4">

                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-medium">Nama</label>
                        <input type="text" name="name" class="form-control form-control-lg rounded-3"
                            value="{{ $client->user->name }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-medium">Email</label>
                        <input type="email" name="email" class="form-control form-control-lg rounded-3"
                            value="{{ $client->user->email }}">
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-medium">Password (Kosongkan jika tidak diubah)</label>
                        <input type="password" name="password" class="form-control form-control-lg rounded-3">
                    </div>
                </div>
            </div>

            <hr class="my-4">

            <div class="mb-3">


                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label fw-medium">Nama Usaha</label>
                        <input type="text" name="nama_usaha" class="form-control form-control-lg rounded-3"
                            value="{{ $client->nama_usaha }}">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label fw-medium">Nomor HP</label>
                        <input type="text" name="nomor_hp" class="form-control form-control-lg rounded-3"
                            value="{{ $client->nomor_hp }}">
                    </div>

                    <div class="col-12">
                        <label class="form-label fw-medium">Alamat</label>
                        <textarea name="alamat" class="form-control form-control-lg rounded-3" rows="3">{{ $client->alamat }}</textarea>
                    </div>
                </div>
            </div>


            <div class="d-flex justify-content-end gap-2 mt-4">


                <a href="{{ route('admin.clients.index') }}"
                    class="btn btn-light border rounded-3 px-4 py-2 d-flex align-items-center">
                    <i class="ti ti-arrow-left fs-5 me-1"></i> Kembali
                </a>

                <button class="btn btn-primary rounded-3 px-4 py-2 fw-semibold d-flex align-items-center">
                    <i class="ti ti-device-floppy fs-5 me-2"></i> Update
                </button>
            </div>
        </form>
    </div>
@endsection

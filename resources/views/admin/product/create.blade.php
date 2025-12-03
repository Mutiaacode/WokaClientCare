@extends('layouts.app')

@section('title', 'Tambah Produk - Admin') 

@section('content')
    <div class="card shadow border-0 p-4">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h4 class="fw-bold m-0">Tambah Produk</h4>

            <a href="{{ route('admin.product.index') }}" class="btn btn-light border px-3 d-flex align-items-center">
                <i class="ti ti-arrow-left me-1 fs-5"></i> Kembali
            </a>
        </div>

        <form action="{{ route('admin.product.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Produk</label>
                <input type="text" name="nama_produk" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Deskripsi</label>
                <textarea name="deskripsi" class="form-control" rows="3"></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Harga Default (Rp)</label>
                <input type="number" name="harga_default" class="form-control" min="0">
            </div>

            <div class="d-flex justify-content-end mt-3">
                <button class="btn btn-primary px-4">
                    Simpan
                </button>
            </div>

        </form>
    </div>
@endsection

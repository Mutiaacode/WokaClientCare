@extends('layouts.app')

@section('content')

<div class="card shadow-sm border-0 p-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold m-0">Edit Produk</h4>

        <a href="{{ route('admin.product.index') }}"
           class="btn btn-light border px-3 d-flex align-items-center">
            <i class="ti ti-arrow-left me-1 fs-5"></i> Kembali
        </a>
    </div>

    <form action="{{ route('admin.product.update', $product->id) }}" method="POST">
        @csrf @method('PUT')

        <div class="mb-3">
            <label class="form-label fw-semibold">Nama Produk</label>
            <input type="text" 
                   name="nama_produk" 
                   class="form-control"
                   value="{{ $product->nama_produk }}" 
                   required>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Deskripsi</label>
            <textarea name="deskripsi" 
                      class="form-control"
                      rows="3">{{ $product->deskripsi }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label fw-semibold">Harga Default (Rp)</label>
            <input type="number" 
                   name="harga_default" 
                   class="form-control"
                   min="0"
                   value="{{ $product->harga_default }}">
        </div>

        <div class="d-flex justify-content-end mt-3">
            <button class="btn btn-primary px-4">
                Update
            </button>
        </div>

    </form>
</div>

@endsection

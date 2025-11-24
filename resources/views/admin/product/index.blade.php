@extends('layouts.app')

@section('content')

 @if (session('sukses'))
            <div class="alert alert-success mt-3 px-4">{{ session('sukses') }}</div>
        @endif


    <div class="card shadow border-0 rounded-3">
        <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white py-3 rounded-top">
            <h4 class="mb-0 text-white">Daftar Produk</h4>
            <a href="{{ route('admin.product.create') }}" class="btn btn-light fw-bold">+ Tambah Produk</a>
        </div>

        <div class="table-responsive p-3">
            <table class="table table-hover table-bordered align-middle mb-0">
                <thead class="table-primary text-center">
                    <tr>
                        <th>Nama Produk</th>
                        <th>Deskripsi</th>
                        <th>Harga Default</th>
                        <th width="150px">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($products as $p)
                        <tr>
                            <td>{{ $p->nama_produk }}</td>
                            <td>{{ $p->deskripsi }}</td>
                            <td>Rp {{ number_format($p->harga_default, 0, ',', '.') }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.product.edit', $p->id) }}"
                                    class="btn btn-warning btn-sm me-1">Edit</a>

                                <form action="{{ route('admin.product.destroy', $p->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin ingin menghapus?')">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

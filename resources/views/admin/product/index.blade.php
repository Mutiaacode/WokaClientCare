@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body d-flex justify-content-between">
            <h4 class="card-title">Daftar Produk</h4>
            <a href="{{ route('admin.product.create') }}" class="btn btn-primary">Tambah Produk</a>
        </div>

        <div class="table-responsive px-3 pb-3">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>Nama Produk</th>
                        <th>Deskripsi</th>
                        <th>Harga Default</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($products as $p)
                        <tr>
                            <td>{{ $p->nama_produk }}</td>
                            <td>{{ $p->deskripsi }}</td>
                            <td>{{ number_format($p->harga_default, 0, ',', '.') }}</td>
                            <td>
                                <a href="{{ route('admin.product.edit', $p->id) }}" class="btn btn-warning btn-sm">Edit</a>

                                <form action="{{ route('admin.product.destroy', $p->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
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

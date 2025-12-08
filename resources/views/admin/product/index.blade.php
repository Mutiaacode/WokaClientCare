@extends('layouts.app')

@section('title', 'Dashboard Produk - Admin')

@section('content')

    @if (session('sukses'))
        <div class="alert alert-success mt-3 px-4">{{ session('sukses') }}</div>
    @endif

    <div class="mb-3">
        <div class="d-flex justify-content-between align-items-center">
            <form action="{{ route('admin.product.index') }}" method="GET" class="flex-grow-1 me-3">
                <div class="input-group">
                    <input type="text" name="search" class="form-control form-control-lg"
                        placeholder="Cari produk berdasarkan nama atau deskripsi..." value="{{ request('search') }}">
                    <button class="btn btn-woka px-4">Cari</button>
                </div>
            </form>

            @if (request('search'))
                <a href="{{ route('admin.product.index') }}" class="btn btn-warning btn-lg">
                    Reset
                </a>
            @endif

        </div>
    </div>



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
                    @forelse ($products as $p)
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
                    @empty
                        <tr>
                            <td colspan="4" class="text-center py-3">Tidak ada produk ditemukan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    @if (isset($notFound) && $notFound)
        <script>
            Swal.fire({
                icon: 'warning',
                title: 'Produk Tidak Ditemukan',
                text: 'Coba gunakan kata kunci lain ya!',
                confirmButtonColor: '#3991A2'
            });
        </script>
    @endif

@endsection

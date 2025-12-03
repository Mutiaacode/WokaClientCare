@extends('layouts.app')

@section('title', 'Dashboad Kontrak - Admin') 

@section('content')

 @if (session('sukses'))
            <div class="alert alert-success mt-3 px-4">{{ session('sukses') }}</div>
        @endif

    <div class="card shadow border-0 rounded-3">
        <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white py-3 rounded-top">
            <h4 class="mb-0 text-white">Data Kontrak</h4>
            <a href="{{ route('admin.contract.create') }}" class="btn btn-light fw-bold">+ Tambah Kontrak</a>
        </div>

        <div class="table-responsive p-3">
            <table class="table table-hover table-bordered align-middle mb-0">
                <thead class="table-primary text-center">
                    <tr>
                        <th>Nomor Kontrak</th>
                        <th>Client</th>
                        <th>Produk</th>
                        <th>Tipe</th>
                        <th>Periode</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th width="180px">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($contracts as $c)
                        <tr>
                            <td>{{ $c->nomor_kontrak }}</td>
                            <td>{{ $c->client->user->name }}</td>
                            <td>{{ $c->product->nama_produk }}</td>
                            <td>{{ ucfirst($c->tipe_kontrak) }}</td>
                            <td class="text-center">
                                {{ strtolower($c->tipe_kontrak) === 'langganan' ? ucfirst($c->periode_tagihan) : '-' }}
                            </td>
                            <td>{{ number_format($c->harga_layanan, 0, ',', '.') }}</td>
                            <td>{{ ucfirst($c->status) }}</td>

                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">

                                    <a href="{{ route('admin.contract.show', $c->id) }}" 
                                       class="btn btn-info btn-sm text-white">
                                        Detail
                                    </a>

                                    <a href="{{ route('admin.contract.edit', $c->id) }}" 
                                       class="btn btn-warning btn-sm">
                                        Edit
                                    </a>

                                    <form action="{{ route('admin.contract.destroy', $c->id) }}" 
                                          method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm"
                                            onclick="return confirm('Hapus kontrak ini?')">
                                            Hapus
                                        </button>
                                    </form>

                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
@endsection

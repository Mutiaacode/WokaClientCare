@extends('layouts.app')

@section('content')
    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white py-3 rounded-top">
            <h4 class="mb-0 text-white">Data Clients</h4>
            <a href="{{ route('admin.clients.create') }}" class="btn btn-light fw-bold">+ Tambah Client</a>
        </div>

        <div class="table-responsive p-3">
            <table class="table table-hover table-bordered align-middle mb-0">
                <thead class="table-primary text-center">
                    <tr>
                        <th>Nama</th>
                        <th>Nama Usaha</th>
                        <th>Nomor HP</th>
                        <th>Email</th>
                        <th width="150px">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($clients as $c)
                        <tr>
                            <td>{{ $c->user->name }}</td>
                            <td>{{ $c->nama_usaha }}</td>
                            <td>{{ $c->nomor_hp }}</td>
                            <td>{{ $c->user->email }}</td>
                            <td class="text-center">
                                <a href="{{ route('admin.clients.edit', $c->id) }}"
                                    class="btn btn-warning btn-sm me-1">Edit</a>

                                <form action="{{ route('admin.clients.destroy', $c->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">
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

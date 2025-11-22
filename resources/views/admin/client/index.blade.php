@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-body d-flex justify-content-between">
            <h4 class="card-title">Data Clients</h4>
            <a href="{{ route('admin.clients.create') }}" class="btn btn-primary">Tambah Client</a>
        </div>

        <div class="table-responsive px-3 pb-3">
            <table class="table table-striped table-bordered">
                <thead class="table">
                    <tr>
                        <th>Nama</th>
                        <th>Nama Usaha</th>
                        <th>Nomor HP</th>
                        <th>Email</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($clients as $c)
                        <tr>
                            <td>{{ $c->user->name }}</td>
                            <td>{{ $c->nama_usaha }}</td>
                            <td>{{ $c->nomor_hp }}</td>
                            <td>{{ $c->user->email }}</td>

                            <td>
                                <a href="{{ route('admin.clients.edit', $c->id) }}" class="btn btn-warning btn-sm">Edit</a>

                                <form action="{{ route('admin.clients.destroy', $c->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin hapus?')">Del</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
@endsection

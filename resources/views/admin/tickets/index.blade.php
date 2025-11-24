@extends('layouts.app')

@section('content')

@if (session('sukses'))
    <div class="alert alert-success mt-3 px-4">{{ session('sukses') }}</div>
@endif

<div class="card shadow border-0 rounded-3">
    <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white py-3 rounded-top">
        <h4 class="mb-0 text-white">Data Tiket</h4>
    </div>

    <div class="table-responsive p-3">
        <table class="table table-hover table-bordered align-middle mb-0">
            <thead class="table-primary text-center">
                <tr>
                    <th>Judul</th>
                    <th>Client</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th width="180px">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach($tickets as $t)
                    <tr>
                        <td>{{ $t->judul }}</td>
                        <td>{{ $t->client->user->name }}</td>
                        <td>{{ ucfirst($t->status) }}</td>
                        <td>{{ $t->created_at->format('d-m-Y') }}</td>

                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">

                                <a href="{{ route('admin.tickets.show', $t->id) }}" 
                                   class="btn btn-info btn-sm text-white">
                                   Detail
                                </a>

                                <form action="{{ route('admin.tickets.destroy', $t->id) }}" 
                                      method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Hapus tiket ini?')">
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
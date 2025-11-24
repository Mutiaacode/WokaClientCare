@extends('layouts.app')

@section('content')
<div class="card shadow-sm border-0 rounded-3">
    <div class="card-header bg-primary text-white py-3 d-flex justify-content-between">
        <h4 class="mb-0">Data Tiket</h4>
    </div>

    <div class="table-responsive p-3">
        <table class="table table-hover table-bordered align-middle mb-0">
            <thead class="table-primary text-center">
                <tr>
                    <th>Judul</th>
                    <th>Client</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th width="120px">Aksi</th>
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
                        <a href="{{ route('admin.tickets.show', $t->id) }}" 
                           class="btn btn-info btn-sm text-white">
                           Detail
                        </a>
                        <form action="{{ route('admin.tickets.destroy', $t->id) }}" method="POST" class="d-inline">
                            @csrf @method('DELETE')
                            <button class="btn btn-danger btn-sm"
                                onclick="return confirm('Hapus tiket ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</div>
@endsection

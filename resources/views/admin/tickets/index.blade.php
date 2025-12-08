@extends('layouts.app')

@section('title', 'Dashboard Tiket - Admin') 

@section('content')

@if (session('sukses'))
    <div class="alert alert-success mt-3 px-4">{{ session('sukses') }}</div>
@endif

 <div class="mb-3 d-flex align-items-center gap-2">

    <form action="{{ route('admin.tickets.index') }}" method="GET" class="d-flex gap-2">
        <select name="status" class="form-select">
            <option value="">-- Semua Status --</option>
            <option value="open" {{ request('status')=='open' ? 'selected' : '' }}>Open</option>
            <option value="in_progress" {{ request('status')=='in_progress' ? 'selected' : '' }}>In Progress</option>
            <option value="waiting_tech" {{ request('status')=='waiting_tech' ? 'selected' : '' }}>Waiting Tech</option>
            <option value="resolved" {{ request('status')=='resolved' ? 'selected' : '' }}>Resolved</option>
            <option value="closed" {{ request('status')=='closed' ? 'selected' : '' }}>Closed</option>
        </select>

        <button class="btn btn-woka">Filter</button>
    </form>

    @if(request('status'))
        <a href="{{ route('admin.tickets.index') }}" class="btn btn-warning">
            Reset
        </a>
    @endif

</div>

    

<div class="card shadow border-0 rounded-3">
    <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white py-4 rounded-top">
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
@if (isset($notFound) && $notFound)
<script>
    Swal.fire({
        icon: 'warning',
        title: 'Tidak Ada Tiket',
        text: 'Tidak ditemukan tiket dengan status tersebut.',
        confirmButtonColor: '#3991A2'
    });
</script>
@endif

@endsection
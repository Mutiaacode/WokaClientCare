@extends('layouts.app')

@section('title', 'Dashboard Invoices - Admin') 

@section('content')
    @if (session('sukses'))
        <div class="alert alert-success mt-3 px-4">{{ session('sukses') }}</div>
    @endif

    <div class="card shadow border-0 rounded-3">
        <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white py-3 rounded-top">
            <h4 class="mb-0 text-white">Data Invoice</h4>
            <a href="{{ route('admin.invoices.create') }}" class="btn btn-light fw-bold">+ Buat Invoice</a>
        </div>

        <div class="table-responsive p-3">
            <table class="table table-hover table-bordered align-middle mb-0">
                <thead class="table-primary text-center">
                    <tr>
                        <th>Invoice</th>
                        <th>Client</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th width="150px">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($invoices as $inv)
                        <tr>
                            <td>#INV-{{ $inv->id }}</td>
                            <td>{{ $inv->contract->client->user->name }}</td>
                            <td>Rp {{ number_format($inv->total, 0, ',', '.') }}</td>
                            <td>{{ ucfirst($inv->status) }}</td>
                            <td>{{ $inv->created_at->format('d-m-Y') }}</td>

                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('admin.invoices.show', $inv->id) }}"
                                        class="btn btn-info btn-sm text-white">Detail</a>

                                    <form action="{{ route('admin.invoices.destroy', $inv->id) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-danger btn-sm"
                                            onclick="return confirm('Hapus invoice ini?')">
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

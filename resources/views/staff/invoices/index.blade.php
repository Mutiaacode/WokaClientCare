@extends('layouts.app')

@section('content')
    @if (session('sukses'))
        <div class="alert alert-success mt-3 px-4">{{ session('sukses') }}</div>
    @endif
    <form action="{{ route('staff.invoices.index') }}" method="GET" class="flex-grow-1 me-3">
                <div class="input-group">
                    <input type="text" name="search" class="form-control form-control-lg "
                        placeholder="Cari invoice berdasarkan nomor invoice atau nama client..." value="{{ request('search') }}">
                    <button class="btn btn-woka px-4">Cari</button>
                </div>
            </form>

            @if (request('search'))
                <a href="{{ route('staff.invoices.index') }}" class="btn btn-warning btn-lg">
                    Reset
                </a>
            @endif
    <br><div class="card shadow border-0 rounded-3">
        <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white py-3 rounded-top">
            <h4 class="mb-0 text-white">Data Invoice</h4>
        </div>

        <div class="table-responsive p-3">
            <table class="table table-hover table-bordered align-middle mb-0">
                <thead class="table-primary text-center">
                    <tr>
                        <th>No</th>
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
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $inv->contract->client->user->name }}</td>
                            <td class="text-center">Rp {{ number_format($inv->total, 0, ',', '.') }}</td>
                            <td class="text-center">
                                @if ($inv->status == 'paid')
                                    <span class="badge bg-success">Paid</span>
                                @elseif ($inv->status == 'unpaid')
                                    <span class="badge bg-danger">Unpaid</span>
                                @else
                                    <span class="badge bg-warning text-dark">Pending</span>
                                @endif
                            </td>
                            <td class="text-center">{{ $inv->created_at->format('d-m-Y') }}</td>

                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('staff.invoices.show', $inv->id) }}"
                                        class="btn btn-info btn-sm text-white">Detail</a>

                                    <form action="{{ route('staff.invoices.destroy', $inv->id) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-danger btn-sm" onclick="return confirm('Hapus invoice ini?')">
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
@extends('layouts.app')

@section('title', 'Dashboard Pembayaran - Admin')

@section('content')

    <div class="mb-3 d-flex gap-2">

        <form action="{{ route('admin.payments.index') }}" method="GET" class="d-flex gap-2">
            <select name="status" class="form-select">
                <option value="">-- Semua Status --</option>
                <option value="paid" {{ request('status') == 'paid' ? 'selected' : '' }}>Paid</option>
                <option value="unpaid" {{ request('status') == 'unpaid' ? 'selected' : '' }}>Unpaid</option>
            </select>

            <button class="btn btn-woka">Filter</button>
        </form>

        @if (request('status'))
            <a href="{{ route('admin.payments.index') }}" class="btn btn-warning">
                Reset
            </a>
        @endif

    </div>

    <div class="card shadow border-0 rounded-3">
        <div class="card-header bg-primary text-white py-4">
            <h4 class="mb-0 text-white">Data Pembayaran</h4>
        </div>

        <div class="table-responsive p-3">
            <table class="table table-bordered table-hover align-middle">
                <thead class="table-primary text-center">
                    <tr>
                        <th>Invoice</th>
                        <th>Client</th>
                        <th>Jumlah</th>
                        <th>Tanggal Bayar</th>
                        <th>Status Invoice</th>
                        <th width="150px">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($payments as $p)
                        <tr>
                            <td>{{ $p->invoice->nomor_invoice }}</td>
                            <td>{{ $p->invoice->contract->client->user->name }}</td>
                            <td>Rp {{ number_format($p->jumlah_dibayar, 0, ',', '.') }}</td>
                            <td>{{ $p->tanggal_pembayaran }}</td>
                            <td>{{ $p->invoice->status }}</td>

                            <td class="text-center">
                                <a href="{{ route('admin.payments.show', $p->id) }}"
                                    class="btn btn-info btn-sm text-white">Detail</a>
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
                title: 'Pembayaran Tidak Ditemukan',
                text: 'Tidak ada data dengan status tersebut.',
                confirmButtonColor: '#3991A2'
            });
        </script>
    @endif

@endsection

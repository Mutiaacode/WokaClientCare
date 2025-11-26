@extends('layouts.app')

@section('content')
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
                                <a href="{{ route('admin.payment.show', $p->id) }}"
                                    class="btn btn-info btn-sm text-white">Detail</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

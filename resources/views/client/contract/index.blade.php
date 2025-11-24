@extends('layouts.app')

@section('title', 'Kontrak Saya')

@section('content')
    <div class="card shadow border-0 rounded-3">
        <div class="card-header bg-primary text-white py-3 rounded-top">
            <h4 class="mb-0 text-white">Kontrak Saya</h4>
        </div>

        <div class="table-responsive p-3">
            <table class="table table-hover table-bordered align-middle mb-0">
                <thead class="table-primary text-center">
                    <tr>
                        <th>Nomor Kontrak</th>
                        <th>Produk</th>
                        <th>Tipe</th>
                        <th>Periode</th>
                        <th>Harga</th>
                        <th>Status</th>
                        <th width="130px">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($contracts as $c)
                        <tr>
                            <td>{{ $c->nomor_kontrak }}</td>
                            <td>{{ $c->product->nama_produk }}</td>
                            <td>{{ ucfirst($c->tipe_kontrak) }}</td>
                            <td class="text-center">
                                {{ $c->tipe_kontrak == 'langganan' ? ucfirst($c->periode_tagihan) : '-' }}
                            </td>
                            <td>Rp {{ number_format($c->harga_layanan, 0, ',', '.') }}</td>
                            <td>
                                <span class="badge 
                                    @if($c->status == 'aktif') bg-success
                                    @elseif($c->status == 'menunggu') bg-warning text-dark
                                    @else bg-danger
                                    @endif
                                ">
                                    {{ ucfirst($c->status) }}
                                </span>
                            </td>

                            <td class="text-center">
                                <a href="{{ route('client.contract.show', $c->id) }}"
                                   class="btn btn-info btn-sm text-white">
                                    Detail
                                </a>

                                @if($c->status == 'menunggu')
                                    <form action="#" method="POST" class="d-inline">
                                        @csrf
                                        <button class="btn btn-success btn-sm"
                                                onclick="return confirm('Setujui kontrak ini?')">
                                            ACC
                                        </button>
                                    </form>
                                @endif
                            </td>

                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
@endsection

@extends('layouts.app')

@section('title', 'Kontrak Saya')

@section('content')
    <div class="card shadow border-0 rounded-3">
        <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white py-3 rounded-top">
            <h4 class="mb-0 text-white">Contract Saya</h4>

            <form action="{{ route('client.contract.index') }}" method="GET" class="d-flex align-items-center"
                style="gap: 15px;">

                <div class="input-group" style="width: 280px;">

                    <button class="input-group-text border-end-0">
                        <i class="ti ti-search text-muted"></i>
                    </button>

                    <input type="text" name="search" class="form-control border-start-0"
                        placeholder="Cari nomor kontrak / produk / tipe..." value="{{ request('search') }}"
                        style="background-color: white; color: #333;">
                </div>
            </form>
        </div>

        @if(request('search'))
            <div class="gap-2 px-3 pt-3">
                <p class="mb-1">Hasil pencarian untuk: "<strong>{{ request('search') }}</strong>"</p>

                @if($contracts->count() === 0)
                    <p class="text-danger mb-0">Tidak ada data ditemukan.</p>
                @endif
            </div>
        @endif

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
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('client.contract.show', $c->id) }}"
                                        class="btn btn-info btn-sm text-white">
                                        Detail
                                    </a>

                                    @if($c->status == 'menunggu')
                                        <form action="{{ route('client.contract.approve', $c->id) }}" method="POST">
                                            @csrf
                                            <button class="btn btn-success btn-sm" onclick="return confirm('Setujui kontrak ini?')">
                                                ACC
                                            </button>
                                        </form>
                                    @endif
                                </div>
                            </td>


                        </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
@endsection
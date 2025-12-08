@extends('layouts.app')

@section('title', 'Invoice Saya')

@section('content')
<div class="card shadow border-0 rounded-3">
    <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white py-3 rounded-top">
            <h4 class="mb-0 text-white">Invoice Saya</h4>

            <form action="{{ route('client.invoice.index') }}" method="GET" class="d-flex align-items-center"
                style="gap: 15px;">

                <div class="input-group" style="width: 280px;">

                    <button class="input-group-text border-end-0">
                        <i class="ti ti-search text-muted"></i>
                    </button>

                    <input type="text" name="search" class="form-control border-start-0"
                        placeholder="Cari nomor invoice / kontrak" value="{{ request('search') }}"
                        style="background-color: white; color: #333;">
                </div>
            </form>
        </div>

        @if(request('search'))
            <div class="gap-2 px-3 pt-3">
                <p class="mb-1">Hasil pencarian untuk: "<strong>{{ request('search') }}</strong>"</p>

                @if($invoices->count() === 0)
                    <p class="text-danger mb-0">Tidak ada data ditemukan.</p>
                @endif
            </div>
        @endif

    <div class="table-responsive p-3">
        <table class="table table-hover table-bordered align-middle mb-0">
            <thead class="table-primary text-center">
                <tr>
                    <th>Invoice</th>
                    <th>Kontrak</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Tanggal</th>
                    <th width="120px">Aksi</th>
                </tr>
            </thead>

            <tbody>
                @foreach ($invoices as $inv)
                <tr>
                    <td>#INV-{{ $inv->id }}</td>
                    <td>{{ $inv->contract->nomor_kontrak }}</td>
                    <td>Rp {{ number_format($inv->total, 0, ',', '.') }}</td>
                    <td>
                        <span class="badge 
                            @if($inv->status == 'paid') bg-success
                            @elseif($inv->status == 'unpaid') bg-danger
                            @else bg-warning text-dark
                            @endif
                        ">
                            {{ ucfirst($inv->status) }}
                        </span>
                    </td>
                    <td>{{ $inv->created_at->format('d-m-Y') }}</td>
                    <td class="text-center">
                        <div class="d-flex justify-content-center gap-2">

                            {{-- Tombol Detail selalu ada --}}
                            <a href="{{ route('client.invoice.show', $inv->id) }}"
                                class="btn btn-info btn-sm text-white">
                                Detail
                            </a>

                            {{-- Tombol Bayar hanya muncul kalau status = unpaid --}}
                         @if($inv->status == 'unpaid')
<a href="{{ route('client.invoice.pay', $inv->id) }}" 
   class="btn btn-success btn-sm">
    Bayar
</a>
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
@extends('layout.app')

@section('content')
<div class="container">

    <h3>Invoice #{{ $invoice->id }}</h3>

    <div class="card p-3 mt-3">
        <p><b>Klien:</b> {{ $invoice->client_name }}</p>
        <p><b>Tanggal:</b> {{ $invoice->created_at->format('d M Y') }}</p>
        <p><b>Status:</b> {{ $invoice->status }}</p>
        <p><b>Total:</b> Rp {{ number_format($invoice->total,0,',','.') }}</p>

        <h4 class="mt-4">Detail</h4>

        <ul>
            @foreach($invoice->items as $item)
            <li>{{ $item->description }} — Rp {{ number_format($item->amount,0,',','.') }}</li>
            @endforeach
        </ul>
    </div>

</div>
@endsection

@extends('layout.app')

@section('content')
<div class="container">
    <h3>Invoice</h3>

    <table class="table mt-3 table-bordered">
        <tr>
            <th>ID</th>
            <th>Klien</th>
            <th>Total</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>

        @foreach($invoices as $inv)
        <tr>
            <td>{{ $inv->id }}</td>
            <td>{{ $inv->client_name }}</td>
            <td>Rp {{ number_format($inv->total,0,',','.') }}</td>
            <td>{{ $inv->status }}</td>
            <td><a href="{{ route('staff.invoices.show',$inv->id) }}" class="btn btn-info btn-sm">Detail</a></td>
        </tr>
        @endforeach
    </table>

    {{ $invoices->links() }}

</div>
@endsection

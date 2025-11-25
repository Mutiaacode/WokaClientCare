@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Invoice Staff</h3>

    <a href="{{ route('staff.invoices.create') }}" class="btn btn-primary mb-3">+ Buat Invoice</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Client</th>
                <th>Jumlah</th>
                <th>Status</th>
                <th>Jatuh Tempo</th>
                <th>Aksi</th>
            </tr>
        </thead>

        <tbody>
            @foreach($invoices as $inv)
            <tr>
                <td>{{ $inv->number }}</td>
                <td>{{ $inv->client->name }}</td>
                <td>Rp {{ number_format($inv->amount) }}</td>
                <td><span class="badge bg-info">{{ $inv->status }}</span></td>
                <td>{{ $inv->due_date }}</td>
                <td>
                    <a href="{{ route('staff.invoices.show', $inv->id) }}" class="btn btn-sm btn-info">Detail</a>
                    <a href="{{ route('staff.invoices.edit', $inv->id) }}" class="btn btn-sm btn-warning">Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $invoices->links() }}
</div>
@endsection

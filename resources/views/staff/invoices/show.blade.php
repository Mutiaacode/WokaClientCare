@extends('staff.layout')

@section('content')
<div class="container">
    <h3>Detail Invoice</h3>

    <div class="card">
        <div class="card-header">
            Invoice {{ $invoice->number }}
        </div>

        <div class="card-body">
            <p><b>Client:</b> {{ $invoice->client->name }}</p>
            <p><b>Jumlah:</b> Rp {{ number_format($invoice->amount) }}</p>
            <p><b>Status:</b> {{ $invoice->status }}</p>
            <p><b>Jatuh Tempo:</b> {{ $invoice->due_date }}</p>
            <p><b>Deskripsi:</b> {{ $invoice->description }}</p>

            <form action="{{ route('staff.invoices.status', $invoice->id) }}" method="POST" class="mt-3">
                @csrf
                <label>Ubah Status</label>
                <select name="status" class="form-control mb-3">
                    <option value="draft" @selected($invoice->status=='draft')>Draft</option>
                    <option value="pending" @selected($invoice->status=='pending')>Pending</option>
                    <option value="paid" @selected($invoice->status=='paid')>Paid</option>
                    <option value="cancelled" @selected($invoice->status=='cancelled')>Cancelled</option>
                </select>
                <button class="btn btn-primary">Update Status</button>
            </form>

        </div>
    </div>
</div>
@endsection

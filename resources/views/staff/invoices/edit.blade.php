@extends('staff.layout')

@section('content')
<div class="container">
    <h3>Edit Invoice</h3>

    <form action="{{ route('staff.invoices.update', $invoice->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Client</label>
            <select name="client_id" class="form-control">
                @foreach($clients as $c)
                    <option value="{{ $c->id }}" @selected($invoice->client_id == $c->id)>
                        {{ $c->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Kontrak</label>
            <select name="contract_id" class="form-control">
                @foreach($contracts as $ct)
                    <option value="{{ $ct->id }}" @selected($invoice->contract_id == $ct->id)>
                        {{ $ct->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Jumlah</label>
            <input type="number" name="amount" class="form-control" value="{{ $invoice->amount }}">
        </div>

        <div class="mb-3">
            <label>Jatuh Tempo</label>
            <input type="date" name="due_date" class="form-control" value="{{ $invoice->due_date }}">
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="description" class="form-control">{{ $invoice->description }}</textarea>
        </div>

        <button class="btn btn-success">Update</button>
    </form>
</div>
@endsection

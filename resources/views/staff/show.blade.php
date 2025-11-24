@extends('layout.app')

@section('content')
<div class="container">

    <h3>Detail Ticket #{{ $ticket->id }}</h3>

    <div class="card mt-3 p-3">
        <h5>{{ $ticket->title }}</h5>
        <p>{{ $ticket->description }}</p>

        <p>Status: <b>{{ $ticket->status }}</b></p>

        @if($ticket->status == 'open')
        <form action="{{ route('staff.tickets.start',$ticket->id) }}" method="POST">
            @csrf
            <button class="btn btn-warning">Ambil Ticket</button>
        </form>
        @endif

        @if($ticket->status == 'in_progress')
        <h4 class="mt-4">Assign Teknisi</h4>

        <form action="{{ route('staff.tickets.assign',$ticket->id) }}" method="POST">
            @csrf

            <label>Pilih Teknisi</label>
            <select name="technician_id" class="form-control">
                @foreach($technicians as $tech)
                <option value="{{ $tech->id }}">{{ $tech->name }}</option>
                @endforeach
            </select>

            <label class="mt-3">Catatan</label>
            <textarea name="log" class="form-control"></textarea>

            <button class="btn btn-success mt-3">Kirim ke Teknisi</button>
        </form>
        @endif

    </div>

</div>
@endsection

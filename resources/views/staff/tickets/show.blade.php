@extends('layout.app')

@section('content')
<div class="container">
    <h3>Detail Tiket #{{ $ticket->id }}</h3>

    <div class="card p-3 mt-3">
        <h4>{{ $ticket->title }}</h4>
        <p>{{ $ticket->description }}</p>
        <p>Status: <b>{{ $ticket->status }}</b></p>

        {{-- open -> in_progress --}}
        @if($ticket->status == 'open')
        <form action="{{ route('staff.tickets.start',$ticket->id) }}" method="POST">
            @csrf
            <button class="btn btn-warning">Mulai Ticket</button>
        </form>
        @endif

        {{-- in_progress -> waiting_tech --}}
        @if($ticket->status == 'in_progress')
        <h4 class="mt-4">Assign Teknisi</h4>

        <form action="{{ route('staff.tickets.assign',$ticket->id) }}" method="POST">
            @csrf

            <label class="mt-2">Pilih Teknisi</label>
            <select name="technician_id" class="form-control">
                @foreach($technicians as $tech)
                <option value="{{ $tech->id }}">{{ $tech->name }}</option>
                @endforeach
            </select>

            <label class="mt-3">Catatan</label>
            <textarea name="log" class="form-control" required></textarea>

            <button class="btn btn-success mt-3">Kirim ke Teknisi</button>
        </form>
        @endif

    </div>

</div>
@endsection

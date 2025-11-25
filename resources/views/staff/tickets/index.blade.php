@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Daftar Tiket Staff</h3>

    <table class="table table-bordered mt-3">
        <tr>
            <th>ID</th>
            <th>Judul</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>

        @foreach($tickets as $t)
        <tr>
            <td>{{ $t->id }}</td>
            <td>{{ $t->title }}</td>
            <td>{{ $t->status }}</td>
            <td><a href="{{ route('staff.tickets.show',$t->id) }}" class="btn btn-info btn-sm">Detail</a></td>
        </tr>
        @endforeach
    </table>


</div>
@endsection

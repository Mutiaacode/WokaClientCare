@extends('layouts.app')

@section('content')
<div class="container">

    <h3>Dashboard Staff</h3>

    <div class="row mt-4">
        <div class="col-md-4">
            <div class="card p-3 bg-primary text-white">
                <h4></h4>
                <p>Tiket OPEN</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3 bg-warning text-white">
                <h4><h4>
                <p>In Progress</p>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card p-3 bg-success text-white">
                <h4></h4>
                <p>Menunggu Teknisi</p>
            </div>
        </div>
    </div>

    <h4 class="mt-4">Tiket Aktif</h4>
    <table class="table table-bordered mt-2">
        <tr>
            <th>ID</th>
            <th>Judul</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </table>

</div>
@endsection

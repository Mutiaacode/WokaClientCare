@extends('layout.app')

@section('title', 'Edit User')

@section('content')

<div class="container mt-4">

    <h3>Edit User: {{ $user->name }}</h3>

    <form action="{{ route('users.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Lengkap</label>
            <input value="{{ $user->name }}" type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Email User</label>
            <input value="{{ $user->email }}" type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Password (Kosongkan jika tidak diganti)</label>
            <input type="password" name="password" class="form-control">
        </div>

        <div class="mb-3">
            <label>Pilih Role</label>
            <select name="role" class="form-control">
                <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="staff" {{ $user->role == 'staff' ? 'selected' : '' }}>Staff</option>
                <option value="klien" {{ $user->role == 'klien' ? 'selected' : '' }}>Klien</option>
                <option value="teknisi" {{ $user->role == 'teknisi' ? 'selected' : '' }}>Teknisi</option>
            </select>
        </div>

        <button class="btn btn-success">Update</button>
        <a href="{{ route('users.index') }}" class="btn btn-secondary">Kembali</a>

    </form>
</div>

@endsection

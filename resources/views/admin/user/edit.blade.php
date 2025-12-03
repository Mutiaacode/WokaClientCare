@extends('layouts.app')

@section('title', 'Edit User - Admin')

@section('content')
    <div class="card shadow-sm border-0 p-4 rounded">

        <h4 class="mb-4 fw-bold">Edit User</h4>

        <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label class="fw-semibold">Nama Pengguna</label>
                <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
            </div>

            <div class="mb-3">
                <label class="fw-semibold">Email</label>
                <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
            </div>

            <div class="mb-3">
                <label class="fw-semibold">Password <small class="text-muted">(kosongkan jika tidak diganti)</small></label>
                <input type="password" name="password" class="form-control">
            </div>

            <div class="mb-3">
                <label class="fw-semibold">Role</label>
                <select name="role" class="form-select">
                    @foreach ($roles as $r)
                        <option value="{{ $r }}" {{ $user->role == $r ? 'selected' : '' }}>
                            {{ ucfirst($r) }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="mt-4 d-flex justify-content-end gap-2">
                <a href="{{ route('admin.users.index') }}" class="btn btn-light ">
                    <i class="ti ti-arrow-left me-1"></i> Kembali
                </a>
                <button class="btn btn-primary">
                    <i class="ti ti-device-floppy me-1"></i> Update
                </button>
            </div>

        </form>

    </div>
@endsection

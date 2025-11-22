@extends('layouts.app')

@section('content')
    <div class="card shadow-sm border-0 p-4 rounded">

        <h4 class="mb-4 fw-bold">Tambah User</h4>

        <form action="{{ route('admin.users.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label class="fw-semibold">Nama Pengguna</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="fw-semibold">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="fw-semibold">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="fw-semibold">Role</label>
                <select name="role" class="form-select" required>
                    @foreach ($roles as $r)
                        <option value="{{ $r }}">{{ ucfirst($r) }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mt-4 d-flex justify-content-end gap-2">
                <a href="{{ route('admin.users.index') }}" class="btn btn-light">
                    <i class="ti ti-arrow-left me-1"></i> Kembali
                </a>
                <button class="btn btn-primary">
                    <i class="ti ti-device-floppy me-1"></i> Simpan
                </button>
            </div>

        </form>
    </div>
@endsection

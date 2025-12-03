@extends('layouts.app')

@section('title', 'Dashboard User - Admin')

@section('content')

    @if (session('sukses'))
        <div class="alert alert-success mt-3 px-4">{{ session('sukses') }}</div>
    @endif

    <div class="card shadow border-0 rounded-3">
        <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white py-3 rounded-top">
            <h4 class="mb-0 text-white">Daftar User</h4>
            <a href="{{ route('admin.users.create') }}" class="btn btn-light fw-bold">
                + Tambah User
            </a>
        </div>
        <div class="table-responsive p-3">
            <table class="table table-hover table-bordered align-middle mb-0">
                <thead class="table-primary text-center">
                    <tr>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Role</th>

                        <th width="150px">Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse ($users as $u)
                        <tr>
                            <td>{{ $u->name }}</td>
                            <td>{{ $u->email }}</td>
                            <td class="text-center">
                                @php
                                    $role = strtolower($u->role);
                                    $badgeColor = match ($role) {
                                        'admin' => 'bg-danger',
                                        'staff' => 'bg-primary',
                                        'teknisi' => 'bg-success',
                                        default => 'bg-secondary',
                                    };
                                @endphp
                                <span class="badge {{ $badgeColor }}">
                                    {{ ucfirst($u->role) }}
                                </span>
                            </td>

                            <td class="text-center">
                                <a href="{{ route('admin.users.edit', $u->id) }}" class="btn btn-warning btn-sm me-1">
                                    Edit
                                </a>

                                <form action="{{ route('admin.users.destroy', $u->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm"
                                        onclick="return confirm('Yakin ingin menghapus user ini?')">
                                        Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>

                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">
                                <i class="fas fa-info-circle me-1"></i> Belum ada data user.
                            </td>
                        </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>
@endsection

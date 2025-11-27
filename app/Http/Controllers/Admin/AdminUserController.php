<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::whereIn('role', ['admin', 'staff', 'teknisi'])->get();
        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        return view('admin.user.create', [
            'roles' => ['admin', 'staff', 'teknisi'],
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'role'     => 'required|in:admin,staff,teknisi',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'role'     => $request->role,
        ]);

        return redirect()->route('admin.users.index')
            ->with('sukses', 'User berhasil ditambahkan!');
    }

    public function edit(User $user)
    {
        return view('admin.user.edit', [
            'user'  => $user,
            'roles' => ['admin', 'staff', 'teknisi'],
        ]);
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'     => 'required|max:255',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',
            'role'     => 'required|in:admin,staff,teknisi',
        ]);

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->update([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => $user->password,
            'role'     => $request->role,
        ]);

        return redirect()->route('admin.users.index')
            ->with('sukses', 'User berhasil diperbarui!');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index')
            ->with('sukses', 'User berhasil dihapus!');
    }
}

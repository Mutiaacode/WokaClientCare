<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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

        $validated = $request->validate([
            'name'     => 'required|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6',
            'role'     => 'required|in:admin,staff,teknisi',
        ]);

        User::create([
            'name'     => $validated['name'],
            'email'    => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role'     => $validated['role'],
            
        ]);

        return redirect()->route('admin.users.index')->with('sukses', 'User berhasil ditambahkan!');
    }

    public function edit($id)
    {
        return view('admin.user.edit', [
            'user'  => User::findOrFail($id),
            'roles' => ['admin', 'staff', 'teknisi'],
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $validated = $request->validate([
            'name'  => 'required|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',
            'role'  => 'required|in:admin,staff,teknisi',
        ]);

        $user->update([
            'name'  => $validated['name'],
            'email' => $validated['email'],
            'password' => !empty($validated['password'])
                ? Hash::make($validated['password'])
                : $user->password,
            'role'  => $validated['role'],
           
        ]);

        return redirect()->route('admin.users.index')->with('sukses', 'User berhasil diperbarui!');
    }

    public function destroy($id)
    {
        User::destroy($id);

        return redirect()->route('admin.users.index')->with('sukses', 'User berhasil dihapus!');
    }
}

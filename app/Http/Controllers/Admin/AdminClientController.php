<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminClientController extends Controller
{
    public function index()
    {
        $clients = Client::with('user')->get();
        return view('admin.clients.index', compact('clients'));
    }

    public function create()
    {
        return view('admin.clients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password'  => 'required|min:6',

            'nama_usaha' => 'required|max:255',
            'nomor_hp' => 'nullable|max:20',
            'alamat' => 'nullable|string',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'client',
        ]);

        Client::create([
            'user_id' => $user->id,
            'nama_usaha' => $request->nama_usaha,
            'nomor_hp' => $request->nomor_hp,
            'alamat'  => $request->alamat,
        ]);

        return redirect()->route('admin.clients.index')->with('sukses', 'Client baru berhasil ditambahkan!');
    }

    public function edit(Client $client)
    {
        $client->load('user');
        return view('admin.clients.edit', compact('client'));
    }

    public function update(Request $request, Client $client)
    {
        $user = $client->user;

        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',

            'nama_usaha' => 'required|max:255',
            'nomor_hp' => 'nullable|max:20',
            'alamat' => 'nullable|string',
        ]);

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $user->password,
        ]);

        $client->update([
            'nama_usaha' => $request->nama_usaha,
            'nomor_hp' => $request->nomor_hp,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('admin.clients.index')->with('sukses', 'Data client berhasil diperbarui!');
    }

    public function destroy(Client $client)
    {
        $client->user->delete();
        $client->delete();

        return redirect()->route('admin.clients.index')->with('sukses', 'Client dan akun user berhasil dihapus!');
    }
}

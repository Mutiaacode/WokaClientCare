<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Client;
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

        $validated = $request->validate([

            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',

            'nama_usaha' => 'required|max:255',
            'nomor_hp' => 'nullable|max:20',
            'alamat' => 'nullable|string',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'client',
        ]);

        Client::create([
            'user_id' => $user->id,
            'nama_usaha' => $validated['nama_usaha'],
            'nomor_hp' => $validated['nomor_hp'] ?? null,
            'alamat' => $validated['alamat'] ?? null,
        ]);

        return redirect()->route('admin.clients.index')->with('sukses', 'Client baru berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $client = Client::with('user')->findOrFail($id);
        return view('admin.clients.edit', compact('client'));
    }

    public function update(Request $request, $id)
    {
        $client = Client::with('user')->findOrFail($id);

        $validated = $request->validate([

            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,' . $client->user->id,
            'password' => 'nullable|min:6',

            'nama_usaha' => 'required|max:255',
            'nomor_hp' => 'nullable|max:20',
            'alamat' => 'nullable|string',
        ]);

        $client->user->update([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => !empty($validated['password'])
                ? Hash::make($validated['password'])
                : $client->user->password,
        ]);

        $client->update([
            'nama_usaha' => $validated['nama_usaha'],
            'nomor_hp' => $validated['nomor_hp'],
            'alamat' => $validated['alamat'],
        ]);

        return redirect()->route('admin.clients.index')->with('sukses', 'Data client berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $client = Client::with('user')->findOrFail($id);

        $client->user->delete();
        $client->delete();

        return redirect()->route('admin.clients.index')->with('sukses', 'Client dan akun user berhasil dihapus!');
    }
}

<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ClientProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $client = $user->client;

        return view('client.profile.index', compact('user', 'client'));
    }

    public function edit()
    {
        $user = Auth::user();
        $client = $user->client;

        return view('client.profile.edit', compact('user', 'client'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'email'       => 'required|email',
            'nama_usaha'  => 'required|string|max:255',
            'nomor_hp'    => 'nullable|string|max:20',
            'alamat'      => 'nullable|string',
            'password'    => 'nullable|min:4',
        ]);

        $user = Auth::user();

        // update users table
        $user->name  = $request->name;
        $user->email = $request->email;

        if ($request->password) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        // update clients table
        $user->client->update([
            'nama_usaha' => $request->nama_usaha,
            'nomor_hp'   => $request->nomor_hp,
            'alamat'     => $request->alamat,
        ]);

        return redirect()->route('client.profile.index')
            ->with('success', 'Profil berhasil diperbarui!');
    }
}

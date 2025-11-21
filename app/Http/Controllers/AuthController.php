<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // menampilkan halaman login
    public function showLogin()
    {
        return view('auth.login');
    }

    // fungsi login
    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {

            $user = Auth::user();

            // ini redirect berdasarkan role
            return match ($user->role) {
                'admin' => redirect()->route('admin.dashboard'),
                'staff' => redirect()->route('staff.dashboard'),
                'teknisi' => redirect()->route('teknisi.dashboard'),
                'client' => redirect()->route('client.dashboard'),
                default => redirect('/'),
            };
        }

        return back()->withErrors(['email' => 'Email atau password salah!']);
    }

    // fungsi logout 
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login')->with('success', 'Logout berhasil.');
    }
}

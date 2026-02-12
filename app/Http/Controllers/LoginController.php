<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        // If a role query param is provided, show the specific login form.
        // Otherwise show the selection page first.
        if ($request->has('role') && in_array($request->query('role'), ['admin', 'siswa'])) {
            $role = $request->query('role');
            return view('login.login', compact('role'));
        }

        return view('select');
    }

    public function login(Request $request)
    {
        $request->validate([
            'role' => 'required|in:admin,siswa',
        ]);

        // ADMIN: email + password (usual flow)
        if ($request->role === 'admin') {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $credentials = [
                'email' => $request->email,
                'password' => $request->password,
                'role' => 'admin',
            ];

            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return redirect('/dashboard')->with('success', 'Selamat datang, ' . Auth::user()->name . '!');
            }

            return back()->withErrors(['email' => 'Email atau password salah'])->withInput();
        }

        // SISWA: hanya NIS (tanpa password)
        $request->validate([
            'nis' => 'required',
        ]);

        $user = User::where('nis', $request->nis)->where('role', 'siswa')->first();

        if (! $user) {
            return back()->withErrors(['nis' => 'NIS tidak ditemukan'])->withInput();
        }

        // login the siswa user without password
        Auth::login($user);
        $request->session()->regenerate();

        return redirect('/dashboard')->with('success', 'Selamat datang, ' . $user->name . '!');
    }


    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}

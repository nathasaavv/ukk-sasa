<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class LoginController extends Controller
{
    public function index(Request $request)
    {
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

        if ($request->role === 'admin') {

            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            if (Auth::attempt([
                'email' => $request->email,
                'password' => $request->password
            ])) {

                $request->session()->regenerate();

                $user = Auth::user();

                if ($user->role !== 'admin') {
                    Auth::logout();

                    return back()->withErrors([
                        'email' => 'Akun ini bukan admin'
                    ]);
                }

                if ($user->status !== 'active') {
                    Auth::logout();

                    return back()->withErrors([
                        'email' => 'Akun Anda telah dinonaktifkan. Hubungi administrator.'
                    ]);
                }

                return redirect()->route('dashboard.index')
                    ->with('success', 'Selamat datang, ' . $user->name . '!');
            }

            return back()->withErrors([
                'email' => 'Email atau password salah'
            ])->withInput();
        }

        if ($request->role === 'siswa') {

            $request->validate([
                'nis' => 'required',
                'password' => 'required',
            ]);

            $user = User::where('nis', $request->nis)
                        ->where('role', 'siswa')
                        ->first();

            if (!$user) {
                return back()->withErrors([
                    'nis' => 'NIS tidak ditemukan'
                ])->withInput();
            }

            if ($user->status !== 'active') {
                return back()->withErrors([
                    'nis' => 'Akun Anda telah dinonaktifkan. Hubungi administrator.'
                ])->withInput();
            }

            // Fallback for students without password
            if (empty($user->password)) {
                if ($request->password === $user->nis) {
                    $user->password = \Illuminate\Support\Facades\Hash::make($request->password);
                    $user->save();
                } else {
                    return back()->withErrors([
                        'password' => 'Untuk login pertama kali, password adalah NIS Anda.'
                    ])->withInput();
                }
            } else {
                if (!\Illuminate\Support\Facades\Hash::check($request->password, $user->password)) {
                    return back()->withErrors([
                        'password' => 'Password salah.'
                    ])->withInput();
                }
            }

            Auth::login($user, $request->boolean('remember'));
            $request->session()->regenerate();

            return redirect()->route('dashboard.siswa')->with('success', 'Selamat datang, ' . $user->name . '!');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}

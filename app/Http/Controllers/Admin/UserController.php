<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Faker\Generator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::orderBy('created_at', 'desc');

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function($builder) use ($q) {
                $builder->where('name', 'LIKE', "%{$q}%")
                        ->orWhere('nis', 'LIKE', "%{$q}%")
                        ->orWhere('email', 'LIKE', "%{$q}%");
            });
        }

        $users = $query->paginate(15);
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

   public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'role' => 'required|in:admin,siswa',
        'status' => 'required|in:active,inactive'
    ]);

    if ($request->role === 'admin') {

        $data = $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        User::create([
            'name' => $request->name,
            'role' => 'admin',
            'status' => $request->status,
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    else {

        $data = $request->validate([
            'nis' => 'required|string|unique:users,nis',
            'status' => 'required|in:active,inactive'
        ]);

        User::create([
            'name' => $request->name,
            'role' => 'siswa',
            'nis' => $data['nis'],
            'status' => $request->status,
            'email' => null,
            'password' => null,
        ]);
    }

    if($request->status === 'inactive') {
        return redirect()->route('login')->with('warning', 'Status Anda Tidak aktif');
    }

    return redirect()
        ->route('admin.users.index')
        ->with('success', 'User berhasil ditambahkan.');
}

    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        
        $rules = [
            'name' => 'required|string|max:255',
            'role' => 'required|in:admin,siswa',
            'status' => 'required|in:active,inactive'
        ];

        // Conditional validation based on role
        if ($request->role === 'admin') {
            $rules['email'] = 'required|email|unique:users,email,' . $user->id;
            $rules['password'] = 'nullable|string|min:6';
        } else if ($request->role === 'siswa') {
            $rules['nis'] = 'nullable|string|unique:users,nis,' . $user->id;
        }

        $data = $request->validate($rules);

        $user->name = $data['name'];
        $user->role = $data['role'];
        $user->status = $data['status'];

        if ($request->role === 'admin' && isset($data['email'])) {
            $user->email = $data['email'];
        }

        if ($request->role === 'admin' && !empty($request->password)) {
            $user->password = Hash::make($request->password);
        }

            if ($request->role === 'siswa' && isset($data['nis'])) {
            $user->nis = $data['nis'];
        }

        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'User berhasil diperbarui.');
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus.');
    }
}

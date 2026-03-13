<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Show the profile edit form.
     */
    public function edit()
    {
        return view('profile.edit', [
            'user' => auth()->user()
        ]);
    }

    /**
     * Update the user profile.
     */
    public function update(Request $request)
    {
        $user = User::find(auth()->id());
        
        $rules = [
            'name' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120', // Increased to 5MB just in case
        ];

        // Check if user is making sensitive changes (changing email for admin, or changing password for anyone)
        $isChangingEmail = $user->role === 'admin' && $request->email !== $user->email;
        $isChangingPassword = $request->filled('password');
        
        if ($user->role === 'admin') {
            $rules['email'] = 'required|email|max:255|unique:users,email,' . $user->id;
        }

        if ($isChangingEmail || $isChangingPassword) {
            $rules['old_password'] = 'required';
        } else {
            $rules['old_password'] = 'nullable';
        }

        if ($request->filled('password')) {
            $rules['password'] = 'nullable|string|min:8|confirmed';
        }

        $validated = $request->validate($rules);

        // Security check: verify old password if requested or making sensitive changes
        if ($isChangingEmail || $isChangingPassword || $request->filled('old_password')) {
            if (!Hash::check($request->old_password, $user->password)) {
                return back()->withErrors(['old_password' => 'Password lama salah!'])->withInput();
            }
        }

        // Handle Photo Upload
        if ($request->hasFile('foto')) {
            // Delete old photo if exists
            if ($user->foto) {
                Storage::disk('public')->delete('profiles/' . $user->foto);
            }

            $extension = $request->foto->getClientOriginalExtension();
            $filename = time() . '_' . $user->id . '.' . $extension;
            $request->foto->storeAs('profiles', $filename, 'public');
            $user->foto = $filename;
        }

        $user->name = $validated['name'];

        if ($user->role === 'admin') {
            $user->email = $validated['email'];
        }

        if ($request->filled('password')) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return back()->with('success', 'Profil berhasil diperbarui!');
    }
}

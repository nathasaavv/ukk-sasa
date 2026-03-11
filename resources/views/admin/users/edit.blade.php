@extends('layouts.app')

@section('title', 'Edit User')

@section('header')
    <h1>Edit User</h1>
@endsection

@section('header-actions')
    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
        <span>←</span>
        <span>Kembali</span>
    </a>
@endsection

@section('content')
    <div class="max-w-2xl mx-auto">
        <div class="card-dark">
            <div class="mb-6">
                <h2 class="text-lg font-semibold text-gray-100">Informasi Akun</h2>
                <p class="text-gray-400 text-sm">Perbarui informasi dasar dan peran pengguna.</p>
            </div>

            <form action="{{ route('admin.users.update', $user) }}" method="POST" class="space-y-5">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name" class="block text-sm font-medium text-gray-300 mb-2">Nama Lengkap</label>
                    <input type="text" id="name" name="name" class="input-dark w-full py-3 px-4" value="{{ old('name', $user->name) }}" required placeholder="Masukkan nama lengkap">
                    @error('name')
                        <div class="mt-2 text-sm text-red-500 font-medium flex items-center gap-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group" id="emailField" style="@if(old('role', $user->role) == 'siswa') display: none; @endif">
                    <label for="email" class="block text-sm font-medium text-gray-300 mb-2">Email</label>
                    <input type="email" id="email" name="email" class="input-dark w-full py-3 px-4" value="{{ old('email', $user->email) }}" placeholder="email@example.com">
                    @error('email')
                        <div class="mt-2 text-sm text-red-500 font-medium flex items-center gap-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <div class="form-group">
                        <label for="role" class="block text-sm font-medium text-gray-300 mb-2">Role</label>
                        <select id="role" name="role" class="input-dark w-full py-3 px-4 appearance-none" required onchange="
                            const role = this.value;
                            const emailField = document.getElementById('emailField');
                            const nisField = document.getElementById('nisField');
                            const passwordField = document.getElementById('passwordField');
                            
                            if (role === 'admin') {
                                emailField.style.display = 'block';
                                nisField.style.display = 'none';
                                passwordField.style.display = 'block';
                            } else if (role === 'siswa') {
                                emailField.style.display = 'none';
                                nisField.style.display = 'block';
                                passwordField.style.display = 'none';
                            }
                        ">
                            <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>Admin</option>
                            <option value="siswa" {{ old('role', $user->role) == 'siswa' ? 'selected' : '' }}>Siswa</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="status" class="block text-sm font-medium text-gray-300 mb-2">Status Akun</label>
                        <select id="status" name="status" class="input-dark w-full py-3 px-4 appearance-none" required>
                            <option value="active" {{ old('status', $user->status) == 'active' ? 'selected' : '' }}>✓ Aktif</option>
                            <option value="inactive" {{ old('status', $user->status) == 'inactive' ? 'selected' : '' }}>✕ Tidak Aktif</option>
                        </select>
                    </div>
                </div>

                <div class="form-group" id="nisField" style="@if(old('role', $user->role) == 'admin') display: none; @endif">
                    <label for="nis" class="block text-sm font-medium text-gray-300 mb-2">NIS</label>
                    <input type="text" id="nis" name="nis" class="input-dark w-full py-3 px-4" value="{{ old('nis', $user->nis) }}" placeholder="Nomor Induk Siswa">
                    @error('nis')
                        <div class="mt-2 text-sm text-red-500 font-medium flex items-center gap-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group" id="passwordField" style="@if(old('role', $user->role) == 'siswa') display: none; @endif">
                    <label for="password" class="block text-sm font-medium text-gray-300 mb-2">Password <span class="text-xs font-normal text-gray-500">(Kosongkan jika tidak ingin mengganti)</span></label>
                    <input type="password" id="password" name="password" class="input-dark w-full py-3 px-4" placeholder="••••••••">
                    @error('password')
                        <div class="mt-2 text-sm text-red-500 font-medium flex items-center gap-1">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg>
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="flex items-center gap-3 pt-4 border-t border-gray-800">
                    <button type="submit" class="btn btn-primary px-6 py-3 flex items-center gap-2">
                        <span>💾</span>
                        <span>Simpan Perubahan</span>
                    </button>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary px-6 py-3">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection

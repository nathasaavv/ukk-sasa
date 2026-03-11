@extends('layouts.app')

@section('title', 'Tambah User')

@section('header')
<h1>Tambah User</h1>
@endsection

@section('header-actions')
<a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
    ← Kembali
</a>
@endsection

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="card-dark">
        <div class="mb-6">
            <h2 class="text-lg font-semibold text-gray-100">Informasi Pengguna Baru</h2>
            <p class="text-gray-400 text-sm">Tambahkan akun baru ke sistem. Pengguna bisa sebagai Admin atau Siswa.</p>
        </div>

        <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-5">
            @csrf

            <div class="form-group">
                <label class="block text-sm font-medium text-gray-300 mb-2">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name') }}" class="input-dark w-full py-3 px-4" placeholder="Masukkan nama lengkap" required>
                @error('name')
                    <div class="mt-2 text-sm text-red-500 font-medium">{{ $message }}</div>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div class="form-group">
                    <label class="block text-sm font-medium text-gray-300 mb-2">Role</label>
                    <select id="role" name="role" class="input-dark w-full py-3 px-4 appearance-none" required onchange="toggleFields()">
                        <option value="admin" {{ old('role')=='admin'?'selected':'' }}>Admin</option>
                        <option value="siswa" {{ old('role')=='siswa'?'selected':'' }}>Siswa</option>
                    </select>
                </div>

                <div class="form-group" id="statusField">
                    <label class="block text-sm font-medium text-gray-300 mb-2">Status Akun</label>
                    <select name="status" class="input-dark w-full py-3 px-4 appearance-none" required>
                        <option value="active" {{ old('status')=='active'?'selected':'' }}>✓ Aktif</option>
                        <option value="inactive" {{ old('status')=='inactive'?'selected':'' }}>✕ Tidak Aktif</option>
                    </select>
                </div>
            </div>

            <div class="form-group" id="emailField">
                <label class="block text-sm font-medium text-gray-300 mb-2">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" class="input-dark w-full py-3 px-4" placeholder="email@example.com">
                @error('email')
                    <div class="mt-2 text-sm text-red-500 font-medium">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group" id="nisField">
                <label class="block text-sm font-medium text-gray-300 mb-2">NIS</label>
                <input type="text" name="nis" value="{{ old('nis') }}" class="input-dark w-full py-3 px-4" placeholder="Nomor Induk Siswa">
                @error('nis')
                    <div class="mt-2 text-sm text-red-500 font-medium">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group" id="passwordField">
                <label class="block text-sm font-medium text-gray-300 mb-2">Password</label>
                <input type="password" id="password" name="password" class="input-dark w-full py-3 px-4" placeholder="••••••••">
                @error('password')
                    <div class="mt-2 text-sm text-red-500 font-medium">{{ $message }}</div>
                @enderror
            </div>

            <div class="flex items-center gap-3 pt-4 border-t border-gray-800">
                <button type="submit" class="btn btn-primary px-6 py-3 flex items-center gap-2">
                    <span>💾</span>
                    <span>Simpan User</span>
                </button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary px-6 py-3">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>

{{-- JAVASCRIPT --}}
<script>
function toggleFields() {

    const role = document.getElementById('role').value;

    const emailField = document.getElementById('emailField');
    const email = document.getElementById('email');

    const nisField = document.getElementById('nisField');

    const passwordField = document.getElementById('passwordField');
    const password = document.getElementById('password');''

    if(role === 'admin') {

        emailField.style.display = 'block';
        passwordField.style.display = 'block';
        nisField.style.display = 'none';

        email.required = true;
        email.disabled = false;

        password.disabled = false;

    } else {

        emailField.style.display = 'none';
        passwordField.style.display = 'none';
        nisField.style.display = 'block';

        email.required = false;
        email.disabled = true;

        password.disabled = true;
    }
}

document.addEventListener('DOMContentLoaded', toggleFields);
</script>

@endsection
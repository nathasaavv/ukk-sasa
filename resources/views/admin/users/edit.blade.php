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
    <div class="form-container" style="max-width:600px;margin:0 auto;padding:20px;">
        <form action="{{ route('admin.users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group" style="margin-bottom:20px;">
                <label for="name" style="display:block;margin-bottom:8px;font-weight:500;">Nama Lengkap</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name', $user->name) }}" required style="width:100%;padding:12px;border:1px solid #ddd;border-radius:6px;">
                @error('name')
                    <div class="alert alert-error" style="margin-top:8px;padding:8px 12px;background:#fee;border-left:4px solid #dc2626;color:#dc2626;font-size:14px;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group" id="emailField" style="margin-bottom:20px; @if(old('role') == 'siswa' || (!old('role') && $user->role == 'siswa')) display: none; @endif">
                <label for="email" style="display:block;margin-bottom:8px;font-weight:500;">Email</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required style="width:100%;padding:12px;border:1px solid #ddd;border-radius:6px;">
                @error('email')
                    <div class="alert alert-error" style="margin-top:8px;padding:8px 12px;background:#fee;border-left:4px solid #dc2626;color:#dc2626;font-size:14px;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group" style="margin-bottom:20px;">
                <label for="role" style="display:block;margin-bottom:8px;font-weight:500;">Role</label>
                <select id="role" name="role" class="form-control" required style="width:100%;padding:12px;border:1px solid #ddd;border-radius:6px;" onchange="
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
                @error('role')
                    <div class="alert alert-error" style="margin-top:8px;padding:8px 12px;background:#fee;border-left:4px solid #dc2626;color:#dc2626;font-size:14px;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group" id="nisField" style="margin-bottom:20px; @if(old('role') == 'admin' || (!old('role') && $user->role == 'admin')) display: none; @endif">
                <label for="nis" style="display:block;margin-bottom:8px;font-weight:500;">NIS</label>
                <input type="text" id="nis" name="nis" class="form-control" value="{{ old('nis', $user->nis) }}" placeholder="Nomor Induk Siswa (Opsional)" style="width:100%;padding:12px;border:1px solid #ddd;border-radius:6px;">
                @error('nis')
                    <div class="alert alert-error" style="margin-top:8px;padding:8px 12px;background:#fee;border-left:4px solid #dc2626;color:#dc2626;font-size:14px;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group" id="passwordField" style="margin-bottom:20px; @if(old('role') == 'siswa' || (!old('role') && $user->role == 'siswa')) display: none; @endif">
                <label for="password" style="display:block;margin-bottom:8px;font-weight:500;">Password <small style="font-weight:normal;color:#666;">(Kosongkan jika tidak ingin mengganti)</small></label>
                <input type="password" id="password" name="password" class="form-control" style="width:100%;padding:12px;border:1px solid #ddd;border-radius:6px;" placeholder="Kosongkan untuk tidak mengganti password">
                @error('password')
                    <div class="alert alert-error" style="margin-top:8px;padding:8px 12px;background:#fee;border-left:4px solid #dc2626;color:#dc2626;font-size:14px;">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-actions" style="display:flex;gap:12px;margin-top:32px;justify-content:flex-start;">
                <button type="submit" class="btn btn-primary" style="padding:12px 24px;background:#3b82f6;color:white;border:none;border-radius:6px;cursor:pointer;font-weight:500;">
                    <span>💾</span>
                    <span>Perbarui User</span>
                </button>
                <a href="{{ route('admin.users.index') }}" class="btn btn-secondary" style="padding:12px 24px;background:#6b7280;color:white;text-decoration:none;border:none;border-radius:6px;font-weight:500;">
                    <span>✖</span>
                    <span>Batal</span>
                </a>
            </div>
        </form>
    </div>
@endsection

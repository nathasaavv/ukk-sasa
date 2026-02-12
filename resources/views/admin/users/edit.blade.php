@extends('layouts.app')

@section('header')
    <h1>Edit User</h1>
@endsection

@section('content')
    <div class="form-container" style="max-width:600px;">
        <form action="{{ route('admin.users.update', $user) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label>Nama</label>
                <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                @error('name')<div class="alert alert-error">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                @error('email')<div class="alert alert-error">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label>Password (kosongkan jika tidak ingin mengganti)</label>
                <input type="password" name="password" class="form-control">
                @error('password')<div class="alert alert-error">{{ $message }}</div>@enderror
            </div>

            <div class="form-group">
                <label>Konfirmasi Password</label>
                <input type="password" name="password_confirmation" class="form-control">
            </div>

            <button class="btn btn-primary" type="submit">Perbarui</button>
            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary" style="margin-left:8px;">Batal</a>
        </form>
    </div>
@endsection

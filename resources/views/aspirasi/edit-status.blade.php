@extends('layouts.app')

@section('title', 'Edit Status Aspirasi')

@section('header')
<div class="flex items-center gap-4">
    <a href="{{ route('aspirasi.show', $aspirasi->id) }}" class="btn-secondary inline-flex items-center gap-2">
        <span>←</span>
        <span>Kembali</span>
    </a>
    <h1 class="text-xl font-semibold">Edit Status Aspirasi</h1>
</div>
@endsection

@section('content')
<div class="max-w-2xl mx-auto">
    <form method="POST" action="{{ route('aspirasi.updateStatus', $aspirasi->id) }}" class="space-y-6">
        @csrf
        @method('PUT')

        <!-- Status Dropdown -->
        <div class="bg-dark-surface rounded-lg border border-gray-800 p-6">
            <label for="status" class="block text-sm font-medium text-gray-400 mb-3">Status <span class="text-red-500">*</span></label>
            <select name="status" id="status" required class="w-full bg-gray-700 text-gray-100 px-4 py-3 rounded border border-gray-600 focus:border-green-500 focus:ring-1 focus:ring-green-500 transition">
                <option value="">-- Pilih Status --</option>
                <option value="Menunggu" {{ $aspirasi->status == 'Menunggu' ? 'selected' : '' }}>⏳ Menunggu Review</option>
                <option value="Diproses" {{ $aspirasi->status == 'Diproses' ? 'selected' : '' }}>🔄 Diproses</option>
                <option value="Ditolak" {{ $aspirasi->status == 'Ditolak' ? 'selected' : '' }}>❌ Ditolak</option>
                <option value="Selesai" {{ $aspirasi->status == 'Selesai' ? 'selected' : '' }}>✅ Selesai</option>
            </select>
            @error('status')
                <span class="text-red-400 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Feedback -->
        <div class="bg-dark-surface rounded-lg border border-gray-800 p-6">
            <label for="feedback" class="block text-sm font-medium text-gray-400 mb-3">Komentar</label>
            <textarea name="feedback_admin" id="feedback" rows="6" placeholder="Tambahkan komentar atau feedback..." class="w-full bg-gray-700 text-gray-100 px-4 py-2 rounded border border-gray-600 focus:border-green-500 focus:ring-1 focus:ring-green-500 transition resize-none"></textarea>
            @error('feedback')
                <span class="text-red-400 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <!-- Buttons -->
        <div class="flex gap-3">
            <button type="submit" class="flex-1 bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded transition">
                💾 Simpan
            </button>
            <a href="{{ route('aspirasi.show', $aspirasi->id) }}" class="flex-1 bg-gray-700 hover:bg-gray-600 text-gray-100 font-semibold py-2 px-4 rounded transition text-center">
                Batal
            </a>
        </div>
    </form>
</div>
@endsection
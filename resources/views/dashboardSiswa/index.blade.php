@extends('layouts.app')

@section('title', 'Dashboard Siswa')

@section('header')
    <h1 class="text-2xl font-bold text-gray-100">Dashboard Siswa</h1>
@endsection

@section('content')
<div class="space-y-6">
    <!-- Welcome Card -->
    <div class="bg-dark-surface rounded-lg border border-gray-800 p-6">
        <div class="flex items-center gap-4">
            <div class="w-16 h-16 bg-green-primary rounded-full flex items-center justify-center">
                <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                </svg>
            </div>
            <div>
                <h2 class="text-xl font-semibold text-gray-100">Selamat Datang, {{ auth()->user()->name }}!</h2>
                <p class="text-gray-400">NIS: {{ auth()->user()->nis }}</p>
                <p class="text-gray-400">Kelas: {{ auth()->user()->kelas ?? 'Tidak ditentukan' }}</p>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->


    <!-- Recent Aspirasi -->
    <div class="bg-dark-surface rounded-lg border border-gray-800 p-6">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-semibold text-gray-100">Aspirasi Terbaru Saya</h3>
            <a href="{{ route('aspirasi.index') }}" class="text-green-primary hover:text-green-secondary transition-colors">Lihat Semua</a>
        </div>

        <div class="space-y-4">
            @forelse(auth()->user()->aspirasis->take(3) ?? [] as $aspirasi)
                <div class="border border-gray-700 rounded-lg p-4 hover:border-gray-600 transition-colors">
                    <div class="flex items-start justify-between">
                        <div class="flex-1">
                            <h4 class="text-lg font-medium text-gray-100">{{ $aspirasi->judul }}</h4>
                            <p class="text-gray-400 text-sm mt-1">{{ Str::limit($aspirasi->isi, 100) }}</p>
                            <div class="flex items-center gap-4 mt-3">
                                <span class="text-xs text-gray-500">Kategori: {{ $aspirasi->kategori->nama ?? 'Umum' }}</span>
                                <span class="text-xs text-gray-500">Status: {{ $aspirasi->status ?? 'Pending' }}</span>
                                <span class="text-xs text-gray-500">{{ $aspirasi->created_at->diffForHumans() }}</span>
                            </div>
                        </div>
                        <div class="ml-4">
                            <span class="px-3 py-1 text-xs rounded-full {{ $aspirasi->status == 'approved' ? 'bg-green-900 text-green-300' : ($aspirasi->status == 'rejected' ? 'bg-red-900 text-red-300' : 'bg-yellow-900 text-yellow-300') }}">
                                {{ ucfirst($aspirasi->status ?? 'pending') }}
                            </span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center py-8">
                    <svg class="w-12 h-12 text-gray-600 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                    <p class="text-gray-400">Belum ada aspirasi yang dikirim</p>
                    <a href="{{ route('aspirasi.create') }}" class="text-green-primary hover:text-green-secondary mt-2 inline-block">Kirim Aspirasi Pertama</a>
                </div>
            @endforelse
        </div>
    </div>

    <!-- Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-dark-surface rounded-lg border border-gray-800 p-6 text-center">
            <div class="text-3xl font-bold text-green-primary">{{ auth()->user()->aspirasis->count() ?? 0 }}</div>
            <div class="text-gray-400 mt-2">Total Aspirasi</div>
        </div>
        <div class="bg-dark-surface rounded-lg border border-gray-800 p-6 text-center">
            <div class="text-3xl font-bold text-blue-400">{{ auth()->user()->aspirasis->where('status', 'approved')->count() ?? 0 }}</div>
            <div class="text-gray-400 mt-2">Aspirasi Disetujui</div>
        </div>
        <div class="bg-dark-surface rounded-lg border border-gray-800 p-6 text-center">
            <div class="text-3xl font-bold text-yellow-400">{{ auth()->user()->aspirasis->where('status', 'pending')->count() ?? 0 }}</div>
            <div class="text-gray-400 mt-2">Menunggu Review</div>
        </div>
    </div>
</div>
@endsection
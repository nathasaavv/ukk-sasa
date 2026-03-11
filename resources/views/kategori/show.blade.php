@extends('layouts.app')

@section('title', 'Detail Kategori')

@section('header')
    <div class="flex items-center gap-4">
        <a href="{{ route('kategori.index') }}" class="btn btn-secondary">
            <span>←</span>
            <span>Kembali</span>
        </a>
        <h1>Detail Kategori</h1>
    </div>
@endsection

@section('header-actions')
    <a href="{{ route('kategori.edit', $kategori->id) }}" class="btn btn-primary">
        <span>✏️</span>
        <span>Edit</span>
    </a>
@endsection

@section('content')
    <div class="space-y-6">
        <!-- Header -->
        <div class="mb-8 p-6 bg-dark-surface rounded-xl border border-gray-800 shadow-sm">
            <div class="flex items-center gap-6">
                <div class="flex items-center justify-center w-16 h-16 text-3xl bg-gray-800 rounded-2xl text-green-primary border border-gray-700 shadow-inner">
                    📁
                </div>
                <div>
                    <h2 class="text-3xl font-bold text-white mb-2">{{ $kategori->nama }}</h2>
                    <p class="text-gray-400 flex items-center gap-2">
                        <span class="w-1.5 h-1.5 rounded-full bg-green-primary"></span>
                        Detail informasi kategori
                    </p>
                </div>
            </div>
        </div>

        <!-- Info Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
            <!-- Informasi Umum -->
            <div class="card-dark group">
                <div class="flex items-center gap-3 mb-6">
                    <span class="text-xl">📋</span>
                    <h3 class="text-lg font-semibold text-white">Informasi Umum</h3>
                </div>
                <div class="space-y-4">
                    <div class="flex justify-between items-center p-3 rounded-lg bg-gray-800/50 border border-gray-700/50">
                        <span class="text-sm text-gray-400 font-medium">Nama Kategori</span>
                        <strong class="text-white">{{ $kategori->nama }}</strong>
                    </div>
                    <div class="flex justify-between items-center p-3 rounded-lg bg-gray-800/50 border border-gray-700/50">
                        <span class="text-sm text-gray-400 font-medium">Keterangan</span>
                        <span class="text-sm text-white">{{ $kategori->ket_kategori ?? 'Tidak ada keterangan' }}</span>
                    </div>
                    <div class="flex justify-between items-center p-3 rounded-lg bg-gray-800/50 border border-gray-700/50">
                        <span class="text-sm text-gray-400 font-medium">Status</span>
                        <span class="px-3 py-1 rounded-full text-xs font-semibold {{ ($kategori->aspirasi_count ?? 0) > 0 ? 'bg-green-500/10 text-green-400 border border-green-500/20' : 'bg-gray-500/10 text-gray-400 border border-gray-500/20' }}">
                            {{ ($kategori->aspirasi_count ?? 0) > 0 ? 'Aktif' : 'Tidak Aktif' }}
                        </span>
                    </div>
                </div>
            </div>

            <!-- Statistik -->
            <div class="card-dark group">
                <div class="flex items-center gap-3 mb-6">
                    <span class="text-xl">📊</span>
                    <h3 class="text-lg font-semibold text-white">Statistik</h3>
                </div>
                <div class="space-y-4">
                    <div class="flex justify-between items-center p-3 rounded-lg bg-gray-800/50 border border-gray-700/50">
                        <span class="text-sm text-gray-400 font-medium">Total Aspirasi</span>
                        <strong class="text-green-primary text-lg">{{ $kategori->aspirasi_count ?? 0 }}</strong>
                    </div>
                    <div class="flex justify-between items-center p-3 rounded-lg bg-gray-800/50 border border-gray-700/50">
                        <span class="text-sm text-gray-400 font-medium">ID Kategori</span>
                        <strong class="text-gray-300">#{{ $kategori->id }}</strong>
                    </div>
                    <div class="flex justify-between items-center p-3 rounded-lg bg-gray-800/50 border border-gray-700/50">
                        <span class="text-sm text-gray-400 font-medium">Dibuat</span>
                        <strong class="text-gray-300">{{ $kategori->created_at ? $kategori->created_at->format('d M Y') : 'N/A' }}</strong>
                    </div>
                </div>
            </div>
        </div>

        <!-- Progress Bar -->
        <div class="card-dark">
            <div class="flex items-center gap-3 mb-6">
                <span class="text-xl">📈</span>
                <h3 class="text-lg font-semibold text-white">Kontribusi Aspirasi</h3>
            </div>
            <div class="bg-gray-800/50 p-6 rounded-xl border border-gray-700/50">
                <div class="flex justify-between items-center mb-4">
                    <span class="text-sm text-gray-400">Distribusi dalam kategori ini</span>
                    <span class="text-sm font-bold text-green-primary bg-green-500/10 px-3 py-1 rounded-lg">
                        {{ $kategori->aspirasi_count ?? 0 }} aspirasi
                    </span>
                </div>
                <div class="w-full bg-gray-900 rounded-full h-4 p-1 border border-gray-700 shadow-inner overflow-hidden">
                    <div class="progress-bar h-full bg-gradient-to-r from-green-500 to-emerald-400 rounded-full transition-all duration-1000 ease-out shadow-[0_0_10px_rgba(16,185,129,0.4)]"
                         style="width: {{ min(($kategori->aspirasi_count ?? 0) * 10, 100) }}%">
                    </div>
                </div>
                <div class="mt-4 flex justify-between text-[10px] text-gray-500 uppercase tracking-widest font-semibold">
                    <span>Mulai</span>
                    <span>Target Capaian</span>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Animate progress bar
            const progressBar = document.querySelector('.progress-bar');
            if (progressBar) {
                const width = progressBar.style.width;
                progressBar.style.width = '0%';
                setTimeout(() => {
                    progressBar.style.width = width;
                }, 100);
            }

            // Animate cards
            const cards = document.querySelectorAll('.card-dark, .bg-dark-surface');
            cards.forEach((card, index) => {
                card.style.opacity = '0';
                card.style.transform = 'translateY(10px)';
                setTimeout(() => {
                    card.style.transition = 'all 0.6s cubic-bezier(0.16, 1, 0.3, 1)';
                    card.style.opacity = '1';
                    card.style.transform = 'translateY(0)';
                }, index * 100);
            });
        });
    </script>
@endpush

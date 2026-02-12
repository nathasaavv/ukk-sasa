@extends('layouts.app')

    @section('title', 'Detail Kategori')

    @section('header')
        <div style="display:flex;align-items:center;gap:15px;">
            <a href="{{ route('kategori.index') }}" class="btn btn-secondary">
                <span>←</span>
                <span>Kembali</span>
            </a>
            <h1>Detail Kategori</h1>
        </div>
    @endsection

    @section('header-actions')

    @endsection

    @section('content')

        <div class="form-container">
            <div class="card-header" style="margin-bottom:25px;">
                <div style="display:flex;align-items:center;gap:15px;">
                    <div class="card-icon blue" style="width:48px;height:48px;font-size:20px;">📁</div>
                    <div>
                        <h2 style="font-size:24px;color:var(--text);margin-bottom:5px;">{{ $kategori->nama }}</h2>
                        <p class="text-muted" style="font-size:14px;">Detail informasi kategori</p>
                    </div>
                </div>
            </div>


            <div class="cards" style="margin-bottom:30px;">
                <div class="card">
                    <h3>📋 Informasi Umum</h3>
                    <div style="margin-top:15px;">
                        <div style="display:flex;justify-content:space-between;margin-bottom:12px;">
                            <span class="text-muted" style="font-size:14px;">Nama Kategori</span>
                            <strong style="color:var(--text);">{{ $kategori->nama }}</strong>
                        </div>
                        <div style="display:flex;justify-content:space-between;margin-bottom:12px;">
                            <span class="text-muted" style="font-size:14px;">Keterangan</span>
                            <span style="color:var(--text);font-size:14px;">{{ $kategori->ket_kategori ?? 'Tidak ada keterangan' }}</span>
                        </div>
                        <div style="display:flex;justify-content:space-between;">
                            <span class="text-muted" style="font-size:14px;">Status</span>
                            <span class="badge {{ $kategori->aspirasi_count ?? 0 > 0 ? 'done' : 'pending' }}">
                                {{ $kategori->aspirasi_count ?? 0 > 0 ? 'Aktif' : 'Tidak Aktif' }}
                            </span>
                        </div>
                    </div>
                </div>

                <div class="card">
                    <h3>📊 Statistik</h3>
                    <div style="margin-top:15px;">
                        <div style="display:flex;justify-content:space-between;margin-bottom:12px;">
                            <span class="text-muted" style="font-size:14px;">Total Aspirasi</span>
                            <strong style="color:var(--text);">{{ $kategori->aspirasi_count ?? 0 }}</strong>
                        </div>
                        <div style="display:flex;justify-content:space-between;margin-bottom:12px;">
                            <span class="text-muted" style="font-size:14px;">ID Kategori</span>
                            <strong style="color:var(--text);">#{{ $kategori->id }}</strong>
                        </div>
                        <div style="display:flex;justify-content:space-between;">
                            <span class="text-muted" style="font-size:14px;">Dibuat</span>
                            <strong style="color:var(--text);">{{ $kategori->created_at->format('d M Y') ?? 'N/A' }}</strong>
                        </div>
                    </div>
                </div>
            </div>


            <div class="card" style="margin-bottom:30px;">
                <h3>📈 Kontribusi Aspirasi</h3>
                <div style="margin-top:15px;">
                    <div style="display:flex;justify-content:space-between;margin-bottom:8px;">
                        <span class="text-muted" style="font-size:14px;">Total: {{ $kategori->aspirasi_count ?? 0 }} aspirasi</span>
                        <span style="color:var(--text);font-size:14px;font-weight:600;">
                            {{ $kategori->aspirasi_count ?? 0 }} aspirasi
                        </span>
                    </div>
                    <div style="background:#e5e7eb;border-radius:8px;height:12px;overflow:hidden;">
                        <div style="background:linear-gradient(90deg,#2563eb,#1d4ed8);height:100%;width:{{ min(($kategori->aspirasi_count ?? 0) * 10, 100) }}%;transition:width 1s ease;border-radius:8px;"></div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @push('scripts')
    <script>

    document.addEventListener('DOMContentLoaded', function() {
        const progressBar = document.querySelector('.form-container .card div[style*="background:linear-gradient"]');
        if (progressBar) {
            const width = progressBar.style.width;
            progressBar.style.width = '0%';
            setTimeout(() => {
                progressBar.style.width = width;
            }, 100);
        }


        const cards = document.querySelectorAll('.card');
        cards.forEach((card, index) => {
            card.style.opacity = '0';
            card.style.transform = 'translateY(20px)';
            setTimeout(() => {
                card.style.transition = 'all 0.5s ease';
                card.style.opacity = '1';
                card.style.transform = 'translateY(0)';
            }, index * 100);
        });
    });
    </script>
    @endpush

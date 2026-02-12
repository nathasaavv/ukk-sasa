@extends('layouts.app')

@section('title', 'Edit Kategori')

@section('header')
    <div style="display:flex;align-items:center;gap:15px;">
        <a href="{{ route('kategori.index') }}" class="btn btn-secondary">
            <span>←</span>
            <span>Kembali</span>
        </a>
        <h1>Edit Kategori</h1>
    </div>
@endsection

@section('content')
    <div style="display:grid;grid-template-columns:1fr 350px;gap:30px;">
        <!-- Form Container -->
        <div class="form-container">
            <div style="margin-bottom:25px;">
                <h2 style="font-size:20px;color:var(--text);margin-bottom:8px;">Form Edit Kategori</h2>
                <p class="text-muted" style="font-size:14px;">Perbarui data kategori di bawah ini</p>
            </div>

            <!-- Flash Messages -->
            @if(session('success'))
            <div class="alert alert-success">
                <span>✅</span>
                <span>{{ session('success') }}</span>
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-error">
                <span>❌</span>
                <span>{{ session('error') }}</span>
            </div>
            @endif

            @if($errors->any())
            <div class="alert alert-warning">
                <span>⚠️</span>
                <div>
                    <strong>Perhatian:</strong>
                    <ul style="margin:5px 0 0 0;padding-left:20px;">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            @endif

            <form action="{{ route('kategori.update', $kategori->id) }}" method="POST" style="display:flex;flex-direction:column;gap:24px;">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nama">Nama Kategori <span style="color:#ef4444;">*</span></label>
                    <input type="text"
                           id="nama"
                           name="nama"
                           class="form-control"
                           placeholder="Masukkan nama kategori"
                           value="{{ old('nama', $kategori->nama) }}"
                           required>
                    <small class="text-muted" style="font-size:12px;margin-top:4px;display:block;">
                        Contoh: Fasilitas Sekolah, Kegiatan Ekstrakurikuler, dll
                    </small>
                </div>

                <div class="form-group">
                    <label for="ket_kategori">Keterangan</label>
                    <textarea id="ket_kategori"
                              name="ket_kategori"
                              class="form-control"
                              rows="4"
                              placeholder="Tambahkan keterangan untuk kategori ini...">{{ old('ket_kategori', $kategori->ket_kategori) }}</textarea>
                    <small class="text-muted" style="font-size:12px;margin-top:4px;display:block;">
                        Opsional: Berikan deskripsi detail tentang kategori ini
                    </small>
                </div>

                <div class="form-group">
                    <label>Status Kategori <span style="color:#ef4444;">*</span></label>
                    <div style="display:flex;gap:20px;margin-top:8px;">
                        <label style="display:flex;align-items:center;gap:8px;cursor:pointer;">
                            <input type="radio"
                                   name="status"
                                   value="1"
                                   {{ old('status', $kategori->status) == '1' ? 'checked' : '' }}
                                   style="width:18px;height:18px;">
                            <span style="color:var(--text);font-size:14px;">Aktif</span>
                        </label>
                        <label style="display:flex;align-items:center;gap:8px;cursor:pointer;">
                            <input type="radio"
                                   name="status"
                                   value="0"
                                   {{ old('status', $kategori->status) == '0' ? 'checked' : '' }}
                                   style="width:18px;height:18px;">
                            <span style="color:var(--text);font-size:14px;">Tidak Aktif</span>
                        </label>
                    </div>
                    <small class="text-muted" style="font-size:12px;margin-top:4px;display:block;">
                        Pilih status untuk kategori ini
                    </small>
                </div>

                <div style="display:flex;gap:12px;flex-wrap:wrap;">
                    <button type="button"
                            class="btn btn-secondary"
                            onclick="window.history.back()">
                        <span>Batal</span>
                    </button>
                    <button type="submit" class="btn btn-primary">
                        <span>Perbarui Kategori</span>
                    </button>
                </div>
            </form>
        </div>

        <!-- Info Sidebar -->
        <div>
            <!-- Current Info Card -->
            <div class="card" style="background:#f0fdf4;border:1px solid #bbf7d0;margin-bottom:20px;">
                <div style="display:flex;align-items:center;gap:10px;margin-bottom:16px;">
                    <div style="width:40px;height:40px;background:#22c55e;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:18px;">📝</div>
                    <h3 style="color:#166534;font-size:16px;margin:0;">Informasi Saat Ini</h3>
                </div>
                <div style="color:#15803d;font-size:14px;line-height:1.6;">
                    <div style="margin-bottom:12px;">
                        <strong style="color:#166534;">Nama:</strong> {{ $kategori->nama }}
                    </div>
                    <div style="margin-bottom:12px;">
                        <strong style="color:#166534;">Status:</strong>
                        <span class="badge {{ $kategori->status ? 'done' : 'pending' }}" style="font-size:12px;">
                            {{ $kategori->status ? 'Aktif' : 'Tidak Aktif' }}
                        </span>
                    </div>
                    <div style="margin-bottom:12px;">
                        <strong style="color:#166534;">Dibuat:</strong> {{ $kategori->created_at->format('d M Y') }}
                    </div>
                    <div>
                        <strong style="color:#166534;">ID:</strong> #{{ $kategori->id }}
                    </div>
                </div>
            </div>

            <!-- Tips Card -->
            <div class="card" style="background:#f0f9ff;border:1px solid #bae6fd;margin-bottom:20px;">
                <div style="display:flex;align-items:center;gap:10px;margin-bottom:16px;">
                    <div style="width:40px;height:40px;background:#0ea5e9;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:18px;">💡</div>
                    <h3 style="color:#0369a1;font-size:16px;margin:0;">Tips Edit Kategori</h3>
                </div>
                <ul style="list-style:none;color:#0c4a6e;font-size:14px;line-height:1.6;margin:0;padding:0;">
                    <li style="margin-bottom:12px;padding-left:20px;position:relative;">
                        <span style="position:absolute;left:0;color:#0ea5e9;">•</span>
                        Pastikan nama kategori tetap jelas dan deskriptif
                    </li>
                    <li style="margin-bottom:12px;padding-left:20px;position:relative;">
                        <span style="position:absolute;left:0;color:#0ea5e9;">•</span>
                        Perbarui keterangan jika ada perubahan penting
                    </li>
                    <li style="margin-bottom:12px;padding-left:20px;position:relative;">
                        <span style="position:absolute;left:0;color:#0ea5e9;">•</span>
                        Non-aktifkan kategori jika tidak lagi digunakan
                    </li>
                    <li style="padding-left:20px;position:relative;">
                        <span style="position:absolute;left:0;color:#0ea5e9;">•</span>
                        Simpan perubahan setelah melakukan edit
                    </li>
                </ul>
            </div>

            <!-- Statistics Card -->
            <div class="card">
                <h3 style="font-size:16px;color:var(--text);margin-bottom:15px;">📊 Statistik Kategori</h3>
                <div style="display:flex;flex-direction:column;gap:12px;">
                    <div style="display:flex;justify-content:space-between;align-items:center;padding:12px;background:#f8fafc;border-radius:8px;">
                        <span class="text-muted" style="font-size:14px;">Total Kategori</span>
                        <strong style="color:var(--text);font-size:16px;">{{ $kategori->count() }}</strong>
                    </div>
                    <div style="display:flex;justify-content:space-between;align-items:center;padding:12px;background:#f8fafc;border-radius:8px;">
                        <span class="text-muted" style="font-size:14px;">Kategori Aktif</span>
                        <strong style="color:var(--text);font-size:16px;">{{$kategori->where('status', 1)->count()}}</strong>
                    </div>
                    <div style="display:flex;justify-content:space-between;align-items:center;padding:12px;background:#f8fafc;border-radius:8px;">
                        <span class="text-muted" style="font-size:14px;">Total Aspirasi</span>
                        <strong style="color:var(--text);font-size:16px;">23</strong>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
// Auto-resize textarea
document.addEventListener('DOMContentLoaded', function() {
    const textarea = document.getElementById('ket_kategori');
    if (textarea) {
        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = this.scrollHeight + 'px';
        });
    }

    // Form validation feedback
    const form = document.querySelector('form');
    const submitBtn = form.querySelector('button[type="submit"]');

    form.addEventListener('submit', function(e) {
        const namaInput = document.getElementById('nama');

        if (!namaInput.value.trim()) {
            e.preventDefault();
            namaInput.focus();
            namaInput.style.borderColor = '#ef4444';

            setTimeout(() => {
                namaInput.style.borderColor = '';
            }, 3000);

            return false;
        }

        // Show loading state
        submitBtn.innerHTML = '<span>⏳</span><span>Memperbarui...</span>';
        submitBtn.disabled = true;
        submitBtn.style.opacity = '0.7';
    });

    // Character counter for textarea
    const textarea = document.getElementById('ket_kategori');
    const maxLength = 500;

    if (textarea) {
        const counter = document.createElement('div');
        counter.style.cssText = 'text-align:right;color:var(--muted);font-size:12px;margin-top:4px;';

        textarea.addEventListener('input', function() {
            const length = this.value.length;
            counter.textContent = length + ' / ' + maxLength;

            if (length > maxLength) {
                counter.style.color = '#ef4444';
                this.value = this.value.substring(0, maxLength);
                counter.textContent = maxLength + ' / ' + maxLength;
            } else {
                counter.style.color = 'var(--muted)';
            }
        });
    }
});
</script>
@endpush

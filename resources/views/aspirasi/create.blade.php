@extends('layouts.app')

@section('title', 'Buat Aspirasi')

@section('header')
    <div style="display:flex;align-items:center;gap:15px;">
        <a href="{{ route('aspirasi.index') }}" class="btn btn-secondary">
            <span>←</span>
            <span>Kembali</span>
        </a>
        <h1>Buat Aspirasi</h1>
    </div>
@endsection

@section('content')
    <div style="display:grid;grid-template-columns:1fr 320px;gap:30px;">
        <!-- Form -->
        <div class="form-container">
            <div style="margin-bottom:20px;">
                <h2 style="font-size:20px;color:var(--text);margin-bottom:6px;">Form Aspirasi</h2>
                <p class="text-muted" style="font-size:14px;">Sampaikan aspirasi atau masukan Anda. Pilih kategori yang sesuai dan jelaskan secara singkat namun jelas.</p>
            </div>

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

            @php
                // fallback jika controller tidak mengirimkan data kategori
                $kategoris = isset($kategori) ? $kategori : \App\Models\Kategori::all();
            @endphp

            <form action="{{ url('/aspirasi/store') }}" method="POST" style="display:flex;flex-direction:column;gap:20px;">
                @csrf

                <div class="form-group">
                    <label for="kategori_id">Kategori <span style="color:#ef4444;">*</span></label>
                    <select id="kategori_id" name="kategori_id" class="form-control" required>
                        <option value="">-- Pilih Kategori --</option>
                        @forelse($kategoris as $item)
                            <option value="{{ $item->id }}" {{ old('kategori_id') == $item->id ? 'selected' : '' }}>{{ $item->nama }}</option>
                        @empty
                            <option value="">(Belum ada kategori)</option>
                        @endforelse
                    </select>
                    <small class="text-muted" style="font-size:12px;margin-top:4px;display:block;">Jika kategori tidak tersedia, tambahkan melalui halaman Kategori.</small>
                </div>

                <div class="form-group">
                    <label for="feedback">Aspirasi / Masukan <span style="color:#ef4444;">*</span></label>
                    <textarea id="feedback" name="feedback" class="form-control" rows="6" placeholder="Tuliskan aspirasi Anda..." required maxlength="2000">{{ old('feedback') }}</textarea>
                    <div style="display:flex;justify-content:space-between;align-items:center;margin-top:6px;">
                        <small class="text-muted">Jelaskan masalah atau saran secara ringkas dan jelas.</small>
                        <small id="counter" class="text-muted">0 / 2000</small>
                    </div>
                </div>

                <input type="hidden" name="status" value="Menunggu">

                <div style="display:flex;gap:12px;flex-wrap:wrap;">
                    <button type="button" class="btn btn-secondary" onclick="window.history.back()">Batal</button>
                    <button type="submit" class="btn btn-primary" id="submitBtn"><span>📨</span> <span>Kirim Aspirasi</span></button>
                </div>
            </form>
        </div>

        <!-- Sidebar / Tips -->
        <div>
            <div class="card" style="background:#f8fafc;border:1px solid #e6eef6;margin-bottom:18px;">
                <div style="display:flex;gap:12px;align-items:center;margin-bottom:12px;">
                    <div style="width:42px;height:42px;background:#60a5fa;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:20px;color:white;">💡</div>
                    <h3 style="font-size:16px;color:#0f172a;margin:0;">Tips Menulis Aspirasi</h3>
                </div>
                <ul style="list-style:none;color:#0f172a;font-size:14px;line-height:1.6;margin:0;padding:0;">
                    <li style="margin-bottom:10px;">• Jelaskan masalah atau saran secara singkat dan konkret.</li>
                    <li style="margin-bottom:10px;">• Sertakan lokasi/kelas jika relevan (mis. gedung, ruang kelas).</li>
                    <li style="margin-bottom:10px;">• Hindari kalimat yang menyinggung—tulis sopan dan konstruktif.</li>
                    <li>• Pilih kategori yang paling sesuai agar penanganan lebih cepat.</li>
                </ul>
            </div>

            <div class="card">
                <h3 style="font-size:14px;color:var(--text);margin-bottom:10px;">Informasi</h3>
                <p class="text-muted" style="font-size:13px;margin:0;">Semua aspirasi siswa akan berstatus <strong>Menunggu</strong> dan akan ditinjau oleh pihak sekolah. Anda akan menerima notifikasi setelah ada tindak lanjut.</p>
                <div style="margin-top:12px;">
                    <a href="{{ route('kategori.create') }}" class="btn btn-sm btn-primary">Tambah Kategori</a>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const textarea = document.getElementById('feedback');
    const counter = document.getElementById('counter');
    const submitBtn = document.getElementById('submitBtn');

    function updateCounter() {
        const len = textarea.value.length;
        counter.textContent = len + ' / ' + textarea.maxLength;
        if (len > textarea.maxLength) {
            counter.style.color = '#ef4444';
        } else {
            counter.style.color = 'var(--muted)';
        }
    }

    if (textarea) {
        textarea.addEventListener('input', function() {
            this.style.height = 'auto';
            this.style.height = this.scrollHeight + 'px';
            updateCounter();
        });
        updateCounter();
    }

    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        // basic client-side validation for UX
        if (!textarea.value.trim()) {
            e.preventDefault();
            textarea.focus();
            textarea.style.borderColor = '#ef4444';
            return false;
        }

        submitBtn.innerHTML = '<span>⏳</span> <span>Mengirim...</span>';
        submitBtn.disabled = true;
        submitBtn.style.opacity = '0.75';
    });
});
</script>
@endpush

@extends('layouts.app')

@section('title', 'Edit Aspirasi')

@section('header')
    <div style="display:flex;align-items:center;gap:15px;">
        <a href="{{ route('aspirasi.index') }}" class="btn btn-secondary">
            <span>←</span>
            <span>Kembali</span>
        </a>
        <h1>Edit Aspirasi</h1>
    </div>
@endsection

@section('content')
<div style="display:grid;grid-template-columns:1fr 320px;gap:30px;">

    <!-- Form -->
    <div class="form-container">
        <div style="margin-bottom:20px;">
            <h2 style="font-size:20px;color:var(--text);margin-bottom:6px;">Form Edit Aspirasi</h2>
            <p class="text-muted" style="font-size:14px;">
                Perbarui aspirasi Anda sebelum ditinjau oleh pihak sekolah.
            </p>
        </div>

        @if(session('success'))
        <div class="alert alert-success">
            <span>✅</span>
            <span>{{ session('success') }}</span>
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

        <form action="{{ route('aspirasi.update', $aspirasi->id) }}" method="POST"
              style="display:flex;flex-direction:column;gap:20px;">
            @csrf
            @method('PUT')

            <!-- Kategori -->
            <div class="form-group">
                <label for="kategori_id">Kategori <span style="color:#ef4444;">*</span></label>
                <select id="kategori_id" name="kategori_id" class="form-control" required>
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($kategori as $item)
                        <option value="{{ $item->id }}" {{ old('kategori_id', $aspirasi->kategori_id) == $item->id ? 'selected' : '' }}>
                            {{ $item->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Aspirasi -->
            <div class="form-group">
                <label for="feedback">Aspirasi / Masukan <span style="color:#ef4444;">*</span></label>
                <textarea id="feedback"
                          name="feedback"
                          class="form-control"
                          rows="6"
                          maxlength="2000"
                          required>{{ old('feedback', $aspirasi->feedback) }}</textarea>

                <div style="display:flex;justify-content:space-between;margin-top:6px;">
                    <small class="text-muted">Gunakan bahasa yang sopan dan jelas.</small>
                    <small id="counter" class="text-muted">0 / 2000</small>
                </div>
            </div>

            <!-- Status (hidden) -->
            <input type="hidden" name="status" value="{{ $aspirasi->status }}">

            <div style="display:flex;gap:12px;">
                <button type="button" class="btn btn-secondary" onclick="window.history.back()">Batal</button>
                <button type="submit" class="btn btn-primary" id="submitBtn">
                    <span>💾</span>
                    <span>Simpan Perubahan</span>
                </button>
            </div>
        </form>
    </div>

    <!-- Sidebar -->
    <div>
        <div class="card" style="background:#f8fafc;border:1px solid #e6eef6;">
            <h3 style="font-size:15px;margin-bottom:10px;">Catatan</h3>
            <p class="text-muted" style="font-size:13px;">
                Aspirasi hanya dapat diedit selama status masih <strong>Menunggu</strong>.
            </p>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const textarea = document.getElementById('feedback');
    const counter = document.getElementById('counter');
    const submitBtn = document.getElementById('submitBtn');

    function updateCounter() {
        counter.textContent = textarea.value.length + ' / ' + textarea.maxLength;
    }

    textarea.addEventListener('input', function () {
        this.style.height = 'auto';
        this.style.height = this.scrollHeight + 'px';
        updateCounter();
    });

    updateCounter();

    document.querySelector('form').addEventListener('submit', function () {
        submitBtn.innerHTML = '<span>⏳</span> Menyimpan...';
        submitBtn.disabled = true;
    });
});
</script>
@endpush
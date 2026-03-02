@extends('layouts.app')

@section('title', 'Buat Aspirasi')

@section('header')
    <div class="flex items-center gap-4">
        <a href="{{ route('aspirasi.index') }}" class="btn-secondary inline-flex items-center gap-2">
            <span>←</span>
            <span>Kembali</span>
        </a>
        <h1 class="text-xl font-semibold">Buat Aspirasi</h1>
    </div>
@endsection

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Form -->
        <div class="lg:col-span-2">
            <div class="mb-6">
                <h2 class="text-lg font-semibold text-gray-100">Form Aspirasi</h2>
                <p class="text-gray-400">Sampaikan aspirasi atau masukan Anda. Pilih kategori yang sesuai dan jelaskan secara singkat namun jelas.</p>
            </div>

            @if(session('success'))
                <div class="mb-4 p-3 rounded-md bg-green-600 text-white">✅ {{ session('success') }}</div>
            @endif

            @if(session('error'))
                <div class="mb-4 p-3 rounded-md bg-red-600 text-white">❌ {{ session('error') }}</div>
            @endif

            @if($errors->any())
                <div class="mb-4 p-3 rounded-md bg-yellow-500 text-black">
                    <strong>Perhatian:</strong>
                    <ul class="mt-2 list-disc list-inside">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @php
                // fallback jika controller tidak mengirimkan data kategori
                $kategoris = isset($kategori) ? $kategori : \App\Models\Kategori::all();
            @endphp

            <form action="{{ url('/aspirasi/store') }}" method="POST" class="space-y-4">
                @csrf

                <div class="form-group">
                    <label for="kategori_id" class="block text-sm text-gray-200">Kategori <span class="text-red-500">*</span></label>
                    <select id="kategori_id" name="kategori_id" class="input-dark mt-2 w-full" required>
                        <option value="">-- Pilih Kategori --</option>
                        @forelse($kategoris as $item)
                            <option value="{{ $item->id }}" {{ old('kategori_id') == $item->id ? 'selected' : '' }}>{{ $item->nama }}</option>
                        @empty
                            <option value="">(Belum ada kategori)</option>
                        @endforelse
                    </select>
                    <small class="text-gray-400 text-sm mt-2 block">Jika kategori tidak tersedia, tambahkan melalui halaman Kategori.</small>
                </div>

                <div class="form-group">
                    <label for="feedback" class="block text-sm text-gray-200">Aspirasi / Masukan <span class="text-red-500">*</span></label>
                    <textarea id="feedback" name="feedback" class="input-dark mt-2 w-full min-h-[140px] resize-none p-3" rows="6" placeholder="Tuliskan aspirasi Anda..." required maxlength="2000">{{ old('feedback') }}</textarea>
                    <div class="flex justify-between items-center mt-2 text-sm">
                        <small class="text-gray-400">Jelaskan masalah atau saran secara ringkas dan jelas.</small>
                        <small id="counter" class="text-gray-400">0 / 2000</small>
                    </div>
                </div>

                <input type="hidden" name="status" value="Menunggu">

                <div class="flex items-center gap-3">
                    <button type="button" class="btn-secondary" onclick="window.history.back()">Batal</button>
                    <button type="submit" class="btn-primary" id="submitBtn"><span>📨</span> <span>Kirim Aspirasi</span></button>
                </div>
            </form>
        </div>
        <!-- Sidebar / Tips -->
        <aside class="space-y-6">
            <div class="card-dark p-4">
                <div class="flex items-start gap-3 mb-3">
                    <div class="w-10 h-10 bg-blue-400 rounded-lg flex items-center justify-center text-white text-lg">💡</div>
                    <div>
                        <h3 class="text-sm font-semibold text-gray-100">Tips Menulis Aspirasi</h3>
                        <p class="text-gray-400 text-sm mb-2">Beberapa panduan singkat agar aspirasi lebih mudah ditindaklanjuti.</p>
                    </div>
                </div>
                <ul class="text-sm text-gray-300 space-y-2 list-disc list-inside">
                    <li>Jelaskan masalah atau saran secara singkat dan konkret.</li>
                    <li>Sertakan lokasi/kelas jika relevan (mis. gedung, ruang kelas).</li>
                    <li>Hindari kalimat yang menyinggung—tulis sopan dan konstruktif.</li>
                    <li>Pilih kategori yang paling sesuai agar penanganan lebih cepat.</li>
                </ul>
            </div>

            <div class="card-dark p-4">
                <h3 class="text-sm font-semibold text-gray-100 mb-2">Informasi</h3>
                <p class="text-sm text-gray-400">Semua aspirasi siswa akan berstatus <strong>Menunggu</strong> dan akan ditinjau oleh pihak sekolah. Anda akan menerima notifikasi setelah ada tindak lanjut.</p>
                <div class="mt-4">
                    <a href="{{ route('kategori.create') }}" class="btn-secondary btn-sm">Tambah Kategori</a>
                </div>
            </div>
        </aside>
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
            counter.classList.remove('text-gray-400');
            counter.classList.add('text-red-500');
        } else {
            counter.classList.remove('text-red-500');
            counter.classList.add('text-gray-400');
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
            textarea.classList.add('ring-2', 'ring-red-500');
            return false;
        }

        submitBtn.innerHTML = '<span>⏳</span> <span>Mengirim...</span>';
        submitBtn.disabled = true;
        submitBtn.classList.add('opacity-75');
    });
});
</script>
@endpush

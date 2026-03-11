@extends('layouts.app')

@section('title', 'Edit Kategori')

@section('header')
    <div class="flex items-center gap-4">
        <a href="{{ route('kategori.index') }}" class="btn-secondary inline-flex items-center gap-2">
            <span>←</span>
            <span>Kembali</span>
        </a>
        <h1 class="text-xl font-semibold">Edit Kategori</h1>
    </div>
@endsection

@section('content')
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Form Container -->
        <div class="lg:col-span-2">
            <div class="mb-6">
                <h2 class="text-lg font-semibold text-gray-100">Form Edit Kategori</h2>
                <p class="text-gray-400">Perbarui data kategori di bawah ini</p>
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

            <form action="{{ route('kategori.update', $kategori->id) }}" method="POST" class="space-y-4">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="nama" class="block text-sm text-gray-200">Nama Kategori <span class="text-red-500">*</span></label>
                    <input type="text" id="nama" name="nama" value="{{ old('nama', $kategori->nama) }}" placeholder="Masukkan nama kategori" required autofocus aria-required="true"
                        class="mt-2 w-full input-dark @error('nama') ring-2 ring-red-500 @enderror"
                    >
                    @error('nama')
                        <p class="text-sm text-red-400 mt-2">{{ $message }}</p>
                    @else
                        <small class="text-gray-400 text-sm mt-2 block">Contoh: Fasilitas Sekolah, Kegiatan Ekstrakurikuler, dll</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="ket_kategori" class="block text-sm text-gray-200">Keterangan</label>
                    <textarea id="ket_kategori" name="ket_kategori" class="input-dark mt-2 w-full p-3 resize-none min-h-[96px] @error('ket_kategori') ring-2 ring-red-500 @enderror" rows="4" placeholder="Tambahkan keterangan untuk kategori ini...">{{ old('ket_kategori', $kategori->ket_kategori) }}</textarea>
                    @error('ket_kategori')
                        <p class="text-sm text-red-400 mt-2">{{ $message }}</p>
                    @else
                        <small class="text-gray-400 text-sm mt-2 block">Opsional: Berikan deskripsi detail tentang kategori ini</small>
                    @enderror
                </div>

                <div class="form-group">
                    <label class="block text-sm text-gray-200">Status Kategori <span class="text-red-500">*</span></label>
                    <div class="flex items-center gap-6 mt-2">
                        <label class="inline-flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="status" value="1" {{ old('status', $kategori->status) == '1' ? 'checked' : '' }} class="form-radio" aria-checked="{{ old('status', $kategori->status) == '1' ? 'true' : 'false' }}" />
                            <span class="text-sm text-gray-200">Aktif</span>
                        </label>
                        <label class="inline-flex items-center gap-2 cursor-pointer">
                            <input type="radio" name="status" value="0" {{ old('status', $kategori->status) == '0' ? 'checked' : '' }} class="form-radio" aria-checked="{{ old('status', $kategori->status) == '0' ? 'true' : 'false' }}" />
                            <span class="text-sm text-gray-200">Tidak Aktif</span>
                        </label>
                    </div>
                    @error('status')
                        <p class="text-sm text-red-400 mt-2">{{ $message }}</p>
                    @enderror
                    <small class="text-gray-400 text-sm mt-2 block">Pilih status untuk kategori ini</small>
                </div>

                <div class="flex items-center gap-3">
                    <button type="button" class="btn-secondary" onclick="window.history.back()">Batal</button>
                    <button type="submit" class="btn-primary" id="submitBtn"><span>💾</span> <span>Perbarui Kategori</span></button>
                </div>
            </form>
        </div>

        <!-- Info Sidebar -->
        <aside class="space-y-6">
            <div class="card-dark p-4">
                <div class="flex items-start gap-3 mb-3">
                    <div class="w-10 h-10 bg-green-400 rounded-lg flex items-center justify-center text-white text-lg">📝</div>
                    <div>
                        <h3 class="text-sm font-semibold text-gray-100">Informasi Saat Ini</h3>
                    </div>
                </div>
                <div class="text-sm text-gray-300 space-y-2">
                    <div><strong class="text-gray-100">Nama:</strong> {{ $kategori->nama }}</div>
                    <div>
                        <strong class="text-gray-100">Status:</strong>
                        <span class="ml-2 px-2 py-1 rounded text-sm {{ $kategori->status ? 'bg-green-600 text-white' : 'bg-gray-700 text-gray-200' }}">{{ $kategori->status ? 'Aktif' : 'Tidak Aktif' }}</span>
                    </div>
                    <div><strong class="text-gray-100">Dibuat:</strong> {{ $kategori->created_at->format('d M Y') }}</div>
                    <div><strong class="text-gray-100">ID:</strong> #{{ $kategori->id }}</div>
                </div>
            </div>

            <div class="card-dark p-4">
                <div class="flex items-start gap-3 mb-3">
                    <div class="w-10 h-10 bg-blue-400 rounded-lg flex items-center justify-center text-white text-lg">💡</div>
                    <div>
                        <h3 class="text-sm font-semibold text-gray-100">Tips Edit Kategori</h3>
                    </div>
                </div>
                <ul class="text-sm text-gray-300 space-y-2 list-disc list-inside">
                    <li>Pastikan nama kategori tetap jelas dan deskriptif</li>
                    <li>Perbarui keterangan jika ada perubahan penting</li>
                    <li>Non-aktifkan kategori jika tidak lagi digunakan</li>
                    <li>Simpan perubahan setelah melakukan edit</li>
                </ul>
            </div>

            <div class="card-dark p-4">
                <h3 class="text-sm font-semibold text-gray-100 mb-3">📊 Statistik Kategori</h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between bg-gray-800 p-3 rounded-md">
                        <span class="text-sm text-gray-400">Total Kategori</span>
                        <strong class="text-sm text-gray-100">{{ \App\Models\Kategori::count() }}</strong>
                    </div>
                    <div class="flex items-center justify-between bg-gray-800 p-3 rounded-md">
                        <span class="text-sm text-gray-400">Kategori Aktif</span>
                        <strong class="text-sm text-gray-100">{{ \App\Models\Kategori::where('status',1)->count() }}</strong>
                    </div>
                    <div class="flex items-center justify-between bg-gray-800 p-3 rounded-md">
                        <span class="text-sm text-gray-400">Total Aspirasi</span>
                        {{-- <strong class="text-sm text-gray-100">{{ \App\Models\Kategori::sum('aspirasi_count') ?? 0 }}</strong> --}}
                    </div>
                </div>
            </div>
        </aside>
    </div>
@endsection

@push('scripts')
<script>
// Auto-resize textarea and enhance UX
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
            namaInput.classList.add('ring-2', 'ring-red-500');

            setTimeout(() => {
                namaInput.classList.remove('ring-2', 'ring-red-500');
            }, 3000);

            return false;
        }

        // Show loading state
        submitBtn.innerHTML = '<span>⏳</span><span> Memperbarui...</span>';
        submitBtn.disabled = true;
        submitBtn.classList.add('opacity-70');
    });

    // Character counter for textarea
    const maxLength = 500;

    if (textarea) {
        const counter = document.createElement('div');
        counter.className = 'text-right text-sm text-gray-400 mt-2';
        counter.textContent = (textarea.value || '').length + ' / ' + maxLength;
        textarea.parentNode.appendChild(counter);

        textarea.addEventListener('input', function() {
            const length = this.value.length;
            counter.textContent = length + ' / ' + maxLength;

            if (length > maxLength) {
                counter.classList.remove('text-gray-400');
                counter.classList.add('text-red-500');
                this.value = this.value.substring(0, maxLength);
                counter.textContent = maxLength + ' / ' + maxLength;
            } else {
                counter.classList.remove('text-red-500');
                counter.classList.add('text-gray-400');
            }
        });
    }
});
</script>
@endpush

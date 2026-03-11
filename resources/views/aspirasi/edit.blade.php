@extends('layouts.app')

@section('title', 'Edit Aspirasi')

@section('header')
    <div class="flex items-center gap-4">
        <a href="{{ route('aspirasi.index') }}" class="btn-secondary inline-flex items-center gap-2">
            <span>←</span>
            <span>Kembali</span>
        </a>
        <h1 class="text-xl font-semibold">Edit Aspirasi</h1>
    </div>
@endsection

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

    <!-- FORM -->
    <div class="lg:col-span-2">

        <div class="mb-6">
            <h2 class="text-lg font-semibold text-gray-100">Form Edit Aspirasi</h2>
            <p class="text-gray-400">
                Perbarui aspirasi Anda sebelum ditinjau oleh pihak sekolah.
            </p>
        </div>

        {{-- Success --}}
        @if(session('success'))
            <div class="mb-4 p-3 rounded-md bg-green-600 text-white">
                ✅ {{ session('success') }}
            </div>
        @endif

        {{-- Error --}}
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

        <form action="{{ route('aspirasi.update', $aspirasi->id) }}"
              method="POST"
              class="space-y-4">

            @csrf
            @method('PUT')

            {{-- KATEGORI --}}
            <div class="form-group">
                <label for="kategori_id" class="block text-sm text-gray-200">
                    Kategori <span class="text-red-500">*</span>
                </label>

                <select id="kategori_id"
                        name="kategori_id"
                        class="input-dark mt-2 w-full"
                        required>

                    <option value="">-- Pilih Kategori --</option>

                    @foreach($kategori as $item)
                        <option value="{{ $item->id }}"
                            {{ old('kategori_id', $aspirasi->kategori_id) == $item->id ? 'selected' : '' }}>
                            {{ $item->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            {{-- FEEDBACK --}}
            <div class="form-group">
                <label for="feedback" class="block text-sm text-gray-200">
                    Aspirasi / Masukan <span class="text-red-500">*</span>
                </label>

                <textarea id="feedback"
                          name="feedback"
                          class="input-dark mt-2 w-full min-h-[140px] resize-none p-3"
                          rows="6"
                          maxlength="2000"
                          required>{{ old('feedback', $aspirasi->feedback) }}</textarea>

                <div class="flex justify-between items-center mt-2 text-sm">
                    <small class="text-gray-400">
                        Gunakan bahasa yang sopan dan jelas.
                    </small>
                    <small id="counter" class="text-gray-400">
                        0 / 2000
                    </small>
                </div>
            </div>

            {{-- STATUS HIDDEN --}}
            <input type="hidden" name="status" value="{{ $aspirasi->status }}">

            {{-- BUTTON --}}
            <div class="flex items-center gap-3">
                <button type="button"
                        class="btn-secondary"
                        onclick="window.history.back()">
                    Batal
                </button>

                <button type="submit"
                        class="btn-primary"
                        id="submitBtn">
                    <span>💾</span>
                    <span>Simpan Perubahan</span>
                </button>
            </div>

        </form>
    </div>

    <!-- SIDEBAR -->
    <aside class="space-y-6">

        <div class="card-dark p-4">
            <h3 class="text-sm font-semibold text-gray-100 mb-2">
                Catatan
            </h3>

            <p class="text-sm text-gray-400">
                Aspirasi hanya dapat diedit selama status masih
                <strong>Menunggu</strong>.
            </p>
        </div>

    </aside>

</div>
@endsection


@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {

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

    textarea.addEventListener('input', function () {
        this.style.height = 'auto';
        this.style.height = this.scrollHeight + 'px';
        updateCounter();
    });

    updateCounter();

    document.querySelector('form').addEventListener('submit', function () {
        submitBtn.innerHTML = '<span>⏳</span> <span>Menyimpan...</span>';
        submitBtn.disabled = true;
        submitBtn.classList.add('opacity-75');
    });

});
</script>
@endpush
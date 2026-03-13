@extends('layouts.app')

@section('title', 'Edit Profil')

@section('header')
    <h1 class="text-2xl font-semibold">Edit Profil</h1>
@endsection

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="card-dark overflow-hidden">
        <!-- Header Profile -->
        <div class="relative h-32 bg-gradient-to-r from-green-600 to-green-900">
            <div class="absolute -bottom-12 left-8">
                <div class="relative group">
                    <div class="w-24 h-24 rounded-2xl bg-dark-surface border-4 border-dark-surface shadow-xl overflow-hidden">
                        @if(auth()->user()->foto)
                            <img src="{{ asset('storage/profiles/' . auth()->user()->foto) }}" alt="Profile" class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-green-500 flex items-center justify-center text-white text-3xl font-bold">
                                {{ substr(auth()->user()->name, 0, 1) }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="pt-16 pb-8 px-8">
            <div class="mb-8">
                <h2 class="text-xl font-bold text-white">{{ auth()->user()->name }}</h2>
                <p class="text-gray-400 capitalize">{{ auth()->user()->role }} • {{ auth()->user()->role === 'admin' ? auth()->user()->email : auth()->user()->nis }}</p>
            </div>

            @if(session('success'))
                <div class="mb-6 p-4 rounded-xl bg-green-500/10 border border-green-500/20 text-green-400 flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                    </svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Nama -->
                    <div class="form-group {{ auth()->user()->role === 'siswa' ? 'md:col-span-2' : '' }}">
                        <label class="block text-sm font-medium text-gray-400 mb-2">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" 
                               class="input-dark w-full py-3 px-4 focus:ring-2 focus:ring-green-500 transition-all" required>
                        @error('name') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <!-- Email (Admin Only) -->
                    @if(auth()->user()->role === 'admin')
                    <div class="form-group">
                        <label class="block text-sm font-medium text-gray-400 mb-2">Email</label>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" 
                               class="input-dark w-full py-3 px-4 focus:ring-2 focus:ring-green-500 transition-all" required>
                        @error('email') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>
                    @endif
                </div>

                <!-- Foto Profile -->
                <div class="form-group">
                    <label class="block text-sm font-medium text-gray-400 mb-2">Foto Profil</label>
                    <div class="flex items-center gap-4">
                        <label class="flex-1 flex flex-col items-center justify-center border-2 border-dashed border-gray-700 rounded-xl p-4 hover:border-green-500 transition-all cursor-pointer bg-gray-800/20 group">
                            <svg class="w-8 h-8 text-gray-500 group-hover:text-green-500 mb-2 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a2 2 0 002 2h12a2 2 0 002-2v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                            </svg>
                            <span class="text-xs text-gray-400 group-hover:text-gray-200">Klik untuk upload foto baru</span>
                            <input type="file" name="foto" class="hidden" accept="image/*" onchange="previewImage(this)">
                        </label>
                        <div id="image-preview" class="w-20 h-20 rounded-xl border border-gray-700 overflow-hidden hidden">
                            <img src="" alt="Preview" class="w-full h-full object-cover">
                        </div>
                    </div>
                    <p class="mt-2 text-[10px] text-gray-500">Format: JPG, PNG. Maks: 2MB</p>
                    @error('foto') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div class="pt-6 border-t border-gray-800 space-y-6">
                    <h3 class="text-sm font-bold text-gray-200 flex items-center gap-2">
                        <svg class="w-4 h-4 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                        </svg>
                        Konfirmasi Keamanan & Ganti Password
                    </h3>

                    <div class="form-group">
                        <label class="block text-sm font-medium text-gray-400 mb-2">Password Saat Ini <span class="text-xs text-yellow-500 font-normal">(Wajib jika ganti {{ auth()->user()->role === 'admin' ? 'Email/' : '' }}Password baru)</span></label>
                        <input type="password" name="old_password" class="input-dark w-full py-3 px-4 focus:ring-2 focus:ring-green-500 transition-all" placeholder="Masukkan password lama">
                        @error('old_password') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="form-group">
                            <label class="block text-sm font-medium text-gray-400 mb-2">Password Baru <span class="text-xs font-normal text-gray-500">(Kosongkan jika tidak ganti)</span></label>
                            <input type="password" name="password" class="input-dark w-full py-3 px-4 focus:ring-2 focus:ring-green-500 transition-all" placeholder="••••••••">
                            @error('password') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                        </div>
                        <div class="form-group">
                            <label class="block text-sm font-medium text-gray-400 mb-2">Konfirmasi Password Baru</label>
                            <input type="password" name="password_confirmation" class="input-dark w-full py-3 px-4 focus:ring-2 focus:ring-green-500 transition-all" placeholder="••••••••">
                        </div>
                    </div>
                </div>

                <div class="flex items-center gap-4 pt-6">
                    <button type="submit" class="px-8 py-3 bg-green-600 hover:bg-green-700 text-white font-bold rounded-xl transition-all shadow-lg shadow-green-900/20 active:scale-95">
                        Simpan Perubahan
                    </button>
                    <a href="{{ url()->previous() }}" class="px-8 py-3 bg-gray-800 hover:bg-gray-700 text-gray-300 font-medium rounded-xl transition-all">
                        Batal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function previewImage(input) {
        const preview = document.getElementById('image-preview');
        const img = preview.querySelector('img');
        
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            reader.onload = function(e) {
                img.src = e.target.result;
                preview.classList.remove('hidden');
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@endsection

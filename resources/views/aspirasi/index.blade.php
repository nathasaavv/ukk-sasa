@extends('layouts.app')

@section('title', 'Siswa Dashboard')

@section('header-actions')
<a href="{{ route('aspirasi.create') }}" class="btn btn-primary">
    <span>➕</span>
    <span>Buat Aspirasi</span>
</a>
@endsection

@section('content')

<div class="space-y-6">

    <!-- FILTER -->
 <div class="card-dark p-6 mb-6">
    <form method="GET" action="{{ route('aspirasi.index') }}">

        <div class="flex items-end gap-4 w-full flex-wrap">

            <!-- Kategori -->
            <div class="flex-1 min-w-[180px]">
                <label class="block text-sm text-gray-400 mb-1">Kategori</label>
                <select name="kategori" class="input-dark w-full py-3 px-4">
                    <option value="">Semua Kategori</option>
                    @foreach ($kategoris as $kat)
                        <option value="{{ $kat->id }}" {{ request('kategori') == $kat->id ? 'selected' : '' }}>
                            {{ $kat->nama }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Status -->
            <div class="flex-1 min-w-[180px]">
                <label class="block text-sm text-gray-400 mb-1">Status</label>
                <select name="status" class="input-dark w-full py-3 px-4">
                    <option value="">Semua Status</option>
                    <option value="Menunggu" {{ request('status') == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                    <option value="Diproses" {{ request('status') == 'Diproses' ? 'selected' : '' }}>Diproses</option>
                    <option value="Selesai" {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
            </div>

            <!-- Bulan -->
            <div class="flex-1 min-w-[180px]">
                <label class="block text-sm text-gray-400 mb-1">Bulan</label>
                <select name="bulan" class="input-dark w-full py-3 px-4">
                    <option value="">Semua Bulan</option>
                    @foreach ($months as $m)
                        <option value="{{ $m->year }}-{{ str_pad($m->month, 2, '0', STR_PAD_LEFT) }}"
                        {{ request('bulan') == $m->year . '-' . str_pad($m->month, 2, '0', STR_PAD_LEFT) ? 'selected' : '' }}>
                        {{ \Carbon\Carbon::createFromFormat('Y-m', $m->year . '-' . str_pad($m->month, 2, '0', STR_PAD_LEFT))
                        ->locale('id')
                        ->translatedFormat('F Y') }}
                        </option>
                    @endforeach
                </select>
            </div>

            <!-- Tanggal -->
            <div class="flex-1 min-w-[180px]">
                <label class="block text-sm text-gray-400 mb-1">Tanggal</label>
                <input 
                    type="date"
                    name="tanggal"
                    value="{{ request('tanggal') }}"
                    class="input-dark w-full py-3 px-4"
                >
            </div>

            <!-- Button kanan -->
            <div class="flex gap-3 ml-auto">
                <button type="submit" class="btn btn-primary px-6 py-3">
                    🔍 Filter
                </button>

                <a href="{{ route('aspirasi.index') }}" class="btn btn-secondary px-6 py-3">
                    Reset
                </a>
            </div>

        </div>

    </form>
</div>

    <!-- HEADER TABEL -->
    <div class="flex items-center justify-between">
        <h2 class="text-lg font-semibold text-gray-100">Aspirasi Terbaru</h2>

        @if (auth()->user()->role === 'siswa')
        <a href="{{ route('aspirasi.create') }}" class="btn-primary inline-flex items-center gap-2">
            <span>➕</span>
            <span>Buat Aspirasi</span>
        </a>
        @endif
    </div>


    <!-- TABEL -->
    <div class="card-dark overflow-auto">
        <table class="min-w-full table-auto text-left">

            <thead>
                <tr class="text-sm text-gray-400 border-b border-gray-700">
                    <th class="py-3 px-4">No</th>
                    <th class="py-3 px-4">Nama</th>
                    <th class="py-3 px-4">Judul</th>
                    <th class="py-3 px-4">Kategori</th>
                    <th class="py-3 px-4">Status</th>
                    <th class="py-3 px-4">Tanggal</th>
                    <th class="py-3 px-4">Aksi</th>
                </tr>
            </thead>

            <tbody id="aspirasiTableBody">

                @forelse ($aspirasis as $index => $aspirasi)

                <tr class="hover:bg-gray-800">

                    <td class="py-3 px-4 align-top">
                        {{ $index + 1 }}
                    </td>

                    <!-- NAMA -->
                    <td class="py-3 px-4 align-top">
                        <div class="flex items-center gap-3">

                            <div class="w-8 h-8 rounded-full bg-gray-700 flex items-center justify-center text-sm font-semibold">
                                {{ strtoupper(substr($aspirasi->user->name ?? 'A', 0, 1)) }}
                            </div>

                            <div class="text-sm">
                                {{ $aspirasi->user->name ?? 'Unknown' }}
                            </div>

                        </div>
                    </td>

                    <!-- JUDUL -->
                    <td class="py-3 px-4 align-top">
                        <div class="font-medium">
                            {{ Str::limit($aspirasi->feedback, 80) }}
                        </div>
                    </td>

                    <!-- KATEGORI -->
                    <td class="py-3 px-4 align-top">
                        <span class="px-2 py-1 rounded-md text-sm bg-gray-700">
                            {{ $aspirasi->kategori->nama }}
                        </span>
                    </td>

                    <!-- STATUS -->
                    <td class="py-3 px-4 align-top">

                        @if(strtolower($aspirasi->status) == 'menunggu')

                        <span class="px-2 py-1 rounded-md text-sm bg-yellow-400 text-black">
                            {{ $aspirasi->status }}
                        </span>

                        @elseif(strtolower($aspirasi->status) == 'selesai')

                        <span class="px-2 py-1 rounded-md text-sm bg-green-primary">
                            {{ $aspirasi->status }}
                        </span>

                        @else

                        <span class="px-2 py-1 rounded-md text-sm bg-gray-600">
                            {{ $aspirasi->status }}
                        </span>

                        @endif

                    </td>

                    <!-- TANGGAL -->
                    <td class="py-3 px-4 align-top">
                        {{ $aspirasi->created_at->format('d M Y') }}
                    </td>

                    <!-- AKSI -->
                    <td class="py-3 px-4 align-top">

                        <div class="relative" 
                            x-data="{ open:false }"
                            @click.away="open=false">

                            <!-- BUTTON TITIK TIGA -->
                            <button @click="open=!open"
                                class="p-2 rounded-lg hover:bg-gray-700 transition">

                                <svg xmlns="http://www.w3.org/2000/svg"
                                    class="w-5 h-5 text-gray-300"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor">

                                    <path stroke-linecap="round"
                                        stroke-linejoin="round"
                                        stroke-width="2"
                                        d="M12 6h.01M12 12h.01M12 18h.01"/>
                                </svg>
                            </button>

                            <!-- DROPDOWN MENU -->
                            <div x-show="open"
                                x-transition
                                x-cloak
                                class="absolute right-0 mt-2 w-48 bg-gray-800 border border-gray-700 rounded-lg shadow-lg overflow-hidden z-50 p-2 space-2">

                                {{-- SISWA --}}
                                @if (auth()->user()->role === 'siswa'
                                    && $aspirasi->user_id === auth()->id()
                                    && strtolower($aspirasi->status) == 'menunggu')

                                    <a href="{{ route('aspirasi.edit', $aspirasi->id) }}"
                                    class="dropdown-item">
                                        ✏️ Edit
                                    </a>

                                    <a href="{{ route('aspirasi.show', $aspirasi->id) }}"
                                    class="dropdown-item">
                                        👁️ Lihat
                                    </a>
                                @endif


                                {{-- ADMIN --}}
                                @if (auth()->user()->role === 'admin')

                                    <a href="{{ route('aspirasi.editStatus', $aspirasi->id) }}"
                                    class="dropdown-item">
                                        ⚙️ Edit Status
                                    </a>

                                @endif


                                {{-- UMPAN BALIK SISWA --}}
                                @if (auth()->user()->role === 'siswa')

                                    <a href="{{ route('aktivitas.index', ['aspirasi_id' => $aspirasi->id]) }}"
                                    class="dropdown-item">
                                        💬 Lihat Umpan Balik
                                    </a>

                                @endif


                                <!-- ARSIP -->
                                <form action="{{ route('archive.aspirasi', $aspirasi->id) }}"
                                    method="POST">
                                    @csrf

                                    <button type="submit"
                                        class="dropdown-item text-red-400 w-full text-left">
                                        📦 Arsipkan
                                    </button>
                                </form>

                            </div>
                        </div>

                    </td>

                </tr>

                @empty

                <tr>
                    <td colspan="7" class="py-6 px-4 text-center text-gray-400">
                        Belum ada aspirasi.
                    </td>
                </tr>

                @endforelse

            </tbody>

        </table>    
    </div>

</div>

@endsection
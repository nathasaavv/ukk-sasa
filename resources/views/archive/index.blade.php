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

                        <div class="flex items-center gap-2">
                            
                            <form action="{{ route('unarchive.aspirasi', $aspirasi->id) }}"
                                    method="POST" onsubmit="confirmAction(event, 'Keluarkan aspirasi ini dari arsip?')">
                                    @method('DELETE')
                                    @csrf

                                    <button type="submit"
                                        class="dropdown-item text-red-400 w-full text-left text-sm">
                                        Batal arsip
                                    </button>
                                </form>
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
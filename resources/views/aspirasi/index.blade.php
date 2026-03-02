@extends('layouts.app')


@section('header-actions')
    <a href="{{ route('aspirasi.create') }}" class="btn btn-primary">
        <span>➕</span>
        <span>Buat Aspirasi</span>
    </a>
@endsection



@section('title', 'Siswa Dashboard')

@section('content')
  <!-- Recent Aspirations Table -->
    <div class="space-y-4">
        <div class="flex items-center justify-between">
            <h2 class="text-lg font-semibold text-gray-100">Aspirasi Terbaru</h2>

            <div class="flex items-center gap-3">
                <div class="relative">
                    <input id="searchAspirasi" type="text" placeholder="Cari aspirasi..." class="input-dark pl-10 pr-4 py-2 w-64" />
                    <svg class="w-4 h-4 text-gray-400 absolute left-3 top-1/2 -mt-2 pointer-events-none" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                </div>

                <select id="filterStatus" class="input-dark py-2 px-3">
                    <option value="">Semua Status</option>
                    <option value="Menunggu">Menunggu</option>
                    <option value="Proses">Proses</option>
                    <option value="Selesai">Selesai</option>
                </select>
                
                <!-- Create button next to search/filter -->
                <a href="{{ route('aspirasi.create') }}" class="btn-primary inline-flex items-center gap-2 ml-2">
                    <span>➕</span>
                    <span>Buat Aspirasi</span>
                </a>
            </div>
        </div>

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
                        <td class="py-3 px-4 align-top">{{ $index + 1 }}</td>
                        <td class="py-3 px-4 align-top">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-gray-700 flex items-center justify-center text-sm font-semibold">{{ strtoupper(substr($aspirasi->user->name ?? 'A', 0, 1)) }}</div>
                                <div class="text-sm">{{ $aspirasi->user->name ?? 'Unknown' }}</div>
                            </div>
                        </td>
                        <td class="py-3 px-4 align-top"><div class="font-medium">{{ Str::limit($aspirasi->feedback, 80) }}</div></td>
                        <td class="py-3 px-4 align-top"><span class="px-2 py-1 rounded-md text-sm bg-gray-700">{{ $aspirasi->kategori->nama }}</span></td>
                        <td class="py-3 px-4 align-top">
                            @if(strtolower($aspirasi->status) == 'menunggu')
                                <span class="px-2 py-1 rounded-md text-sm bg-yellow-400 text-black">{{ $aspirasi->status }}</span>
                            @elseif(strtolower($aspirasi->status) == 'selesai')
                                <span class="px-2 py-1 rounded-md text-sm bg-green-primary">{{ $aspirasi->status }}</span>
                            @else
                                <span class="px-2 py-1 rounded-md text-sm bg-gray-600">{{ $aspirasi->status }}</span>
                            @endif
                        </td>
                        <td class="py-3 px-4 align-top">{{ $aspirasi->created_at->format('d M Y') }}</td>
                        <td class="py-3 px-4 align-top">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('aspirasi.show', $aspirasi->id) }}" class="btn btn-sm btn-primary">Lihat</a>
                                <a href="{{ route('aspirasi.edit', $aspirasi->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="py-6 px-4 text-center text-gray-400">Belum ada aspirasi.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

@endsection

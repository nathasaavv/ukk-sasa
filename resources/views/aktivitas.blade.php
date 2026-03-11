@extends('layouts.app')

@section('title', 'Aktivitas')

@section('content')
<!-- Recent Activity -->
<div class="text-end mb-4">
    <button onclick="window.history.back()" class="btn btn-primary">Kembali</button>
</div>
<div class="card-dark mt-8 p-6">
    <h2 class="text-lg font-semibold text-white mb-4">
        🕒 {{ request('aspirasi_id') ? 'Detail Aktivitas Aspirasi' : 'Aktivitas Terbaru' }}
    </h2>

    @if(request('aspirasi_id'))
        <div class="mb-4 p-3 bg-gray-800 rounded-lg">
            <div class="flex justify-between items-center">
                <p class="text-sm text-gray-300">
                    Menampilkan aktivitas untuk aspirasi yang dipilih
                </p>
                <a href="{{ route('aktivitas.index') }}" class="btn btn-sm btn-secondary">
                    Lihat Semua Aktivitas
                </a>
            </div>
        </div>
    @endif

    <div class="space-y-4 text-sm">
        @forelse($aktivitas as $item)
            @if(request('aspirasi_id'))
                <!-- Detail View untuk satu aspirasi -->
                <div class="bg-gray-800/50 p-4 rounded-lg">
                    <div class="flex items-center gap-2 mb-3">
                        <span class="text-blue-400">📝</span>
                        <span class="text-white font-semibold">Detail Aspirasi</span>
                    </div>
                    
                    <div class="space-y-3">
                        <div>
                            <span class="text-gray-400 text-sm">Pengirim:</span>
                            <span class="text-white ml-2">{{ $item->user->name ?? 'Unknown' }}</span>
                        </div>
                        
                        <div>
                            <span class="text-gray-400 text-sm">Kategori:</span>
                            <span class="text-white ml-2">{{ $item->kategori->nama ?? 'Umum' }}</span>
                        </div>
                        
                        <div>
                            <span class="text-gray-400 text-sm">Status:</span>
                            <span class="ml-2 px-2 py-1 rounded text-sm 
                                @if(strtolower($item->status) == 'menunggu') bg-yellow-400 text-black
                                @elseif(strtolower($item->status) == 'selesai') bg-green-primary
                                @else bg-gray-600 @endif">
                                {{ $item->status }}
                            </span>
                        </div>
                        
                        <div>
                            <span class="text-gray-400 text-sm">Isi Aspirasi:</span>
                            <div class="text-white mt-1 p-3 bg-gray-900 rounded">{{ $item->feedback }}</div>
                        </div>
                        
                        @if($item->feedback_admin)
                        <div>
                            <span class="text-gray-400 text-sm">Tanggapan Admin:</span>
                            <div class="text-green-400 mt-1 p-3 bg-gray-900 rounded">{{ $item->feedback_admin }}</div>
                        </div>
                        @endif
                        
                        <div class="text-xs text-gray-500 pt-2 border-t border-gray-700">
                            Dibuat: {{ $item->created_at->format('d M Y H:i') }} | 
                            Terakhir update: {{ $item->updated_at->format('d M Y H:i') }}
                        </div>
                    </div>
                </div>
            @else
                <!-- List View untuk semua aktivitas -->
                <div class="flex justify-between border-b border-gray-700 pb-3 hover:bg-gray-900/30 px-2 py-1 rounded transition">
                    <div class="flex-1">
                        <div class="flex items-center gap-2">
                            @if($item->created_at->diffInMinutes(now()) <= 5)
                                <span class="text-green-400">✓</span>
                                <span class="text-gray-300">
                                    <strong>{{ $item->user->name ?? 'User' }}</strong> menambahkan aspirasi baru:
                                    <em>"{{ Str::limit($item->feedback, 50) }}"</em>
                                </span>
                            @elseif($item->feedback)
                                <span class="text-blue-400">💬</span>
                                <span class="text-gray-300">
                                    Admin memberikan tanggapan pada aspirasi
                                    <em>"{{ Str::limit($item->feedback, 50) }}"</em>
                                </span>
                            @elseif(in_array($item->status, ['approved', 'rejected']))
                                <span class="text-yellow-400">✅</span>
                                <span class="text-gray-300">
                                    Aspirasi <em>"{{ Str::limit($item->feedback, 50) }}"</em> telah
                                    <span class="font-semibold {{ $item->status == 'approved' ? 'text-green-400' : 'text-red-400' }}">
                                        {{ $item->status == 'approved' ? 'disetujui' : 'ditolak' }}
                                    </span>
                                </span>
                            @else
                                <span class="text-purple-400">📝</span>
                                <span class="text-gray-300">
                                    Status aspirasi <em>"{{ Str::limit($item->feedback, 50) }}"</em> diperbarui menjadi
                                    <span class="font-semibold">{{ ucfirst($item->status) }}</span>
                                </span>
                            @endif
                        </div>
                        <div class="text-xs text-gray-500 ml-5 mt-1">
                            Kategori: <span class="text-gray-400">{{ $item->kategori->nama ?? 'Umum' }}</span>
                        </div>
                    </div>
                    <div class="flex items-center gap-2 mt-2">
                        <a href="{{ route('aktivitas.index', ['aspirasi_id' => $item->id]) }}" class="text-xs text-blue-400 hover:text-blue-300">
                            Lihat Detail →
                        </a>
                        <span class="text-gray-500 whitespace-nowrap">{{ $item->updated_at->diffForHumans() }}</span>
                    </div>
                </div>
            @endif
        @empty
            <div class="text-center py-8">
                <p class="text-gray-400">Belum ada aktivitas</p>
            </div>
        @endforelse
    </div>

    @if($aktivitas->count() > 0)
        <div class="mt-6 pt-4 border-t border-gray-700">
            <p class="text-xs text-gray-500">
                @if(request('aspirasi_id'))
                    Menampilkan detail aktivitas aspirasi
                @else
                    Menampilkan {{ $aktivitas->count() }} aktivitas terbaru
                @endif
            </p>
        </div>
    @endif
</div>
@endsection
@extends('layouts.app')

@section('title', 'Manajemen Kategori')

@section('header')
    <h1>Manajemen Kategori</h1>
@endsection

@section('header-actions')
    <a href="{{ route('kategori.create') }}" class="btn btn-primary">
        <span>➕</span>
        <span>Tambah Kategori</span>
    </a>
@endsection

@section('content')
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

   

    <div class="space-y-4">
        <div class="flex items-center justify-between">
            <h2 class="text-lg font-semibold text-gray-100">Daftar Kategori</h2>

            <div class="flex items-center gap-3">
                <input id="searchKategori" type="text" placeholder="Cari kategori..." value="{{ request('search') }}" class="input-dark pl-3 pr-3 py-2" />
                <select id="filterStatus" class="input-dark py-2 px-3">
                    <option value="">Semua Status</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                </select>
                <button type="button" onclick="performSearch()" class="btn-primary">Cari</button>
            </div>
        </div>

        <div class="card-dark overflow-auto">
            <table id="kategoriTable" class="min-w-full table-auto text-left">
                <thead>
                    <tr class="text-sm text-gray-400 border-b border-gray-700">
                        <th class="py-3 px-4">No</th>
                        <th class="py-3 px-4">Nama Kategori</th>
                        <th class="py-3 px-4">Keterangan</th>
                        <th class="py-3 px-4">Jumlah Aspirasi</th>
                        <th class="py-3 px-4">Status</th>
                        <th class="py-3 px-4">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($kategori as $item)
                    <tr class="hover:bg-gray-800">
                        <td class="py-3 px-4 align-top">{{ $loop->iteration }}</td>
                        <td class="py-3 px-4 align-top">
                            <div class="flex items-center gap-3">
                                <div class="w-9 h-9 rounded-lg bg-blue-600 flex items-center justify-center text-white">📁</div>
                                <strong class="text-sm">{{ $item->nama }}</strong>
                            </div>
                        </td>
                        <td class="py-3 px-4 align-top text-sm text-gray-400">{{ Str::limit($item->ket_kategori ?? 'Tidak ada keterangan', 60) }}</td>
                        <td class="py-3 px-4 align-top">
                            <span class="px-2 py-1 rounded-md text-sm {{ ($item->aspirasi_count ?? 0) > 0 ? 'bg-green-primary text-white' : 'bg-gray-600 text-white' }}">{{ $item->aspirasi_count ?? 0 }} aspirasi</span>
                        </td>
                        <td class="py-3 px-4 align-top">
                            <span class="px-2 py-1 rounded-md text-sm {{ $item->status ? 'bg-green-primary text-white' : 'bg-gray-600 text-white' }}">{{ $item->status ? 'Aktif' : 'Tidak Aktif' }}</span>
                        </td>
                        <td class="py-3 px-4 align-top">
                            <div class="flex items-center gap-2">
                                <a href="{{ route('kategori.show', $item->id) }}" class="btn btn-sm btn-primary">Lihat</a>
                                <a href="{{ route('kategori.edit', $item->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('kategori.destroy', $item->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="py-8 px-4">
                            <div class="text-center">
                                <div class="text-4xl">📂</div>
                                <h3 class="text-lg font-semibold text-gray-100 mt-4">Belum ada kategori</h3>
                                <p class="text-gray-400 mt-2">Mulai dengan menambahkan kategori pertama</p>
                                <a href="{{ route('kategori.create') }}" class="btn-primary inline-flex items-center gap-2 mt-4">➕ Tambah Kategori</a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection

@push('scripts')
<script>
// Function performSearch didefinisikan di luar DOM loaded
function performSearch() {
    console.log('Search function called'); // Debug log
    const searchTerm = document.getElementById('searchKategori').value;
    const statusFilter = document.getElementById('filterStatus').value;
    let url = '{{ route('kategori.index') }}';

    // Build URL dengan parameters
    const params = new URLSearchParams();

    if (searchTerm.trim()) {
        params.append('search', searchTerm.trim());
    }

    if (statusFilter) {
        params.append('status', statusFilter);
    }

    // Add parameters ke URL
    if (params.toString()) {
        url += '?' + params.toString();
    }

    console.log('Redirecting to:', url); // Debug log
    window.location.href = url;
}

// Pastikan DOM loaded
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM loaded'); // Debug log

    // Test function availability
    console.log('performSearch function exists:', typeof performSearch); // Debug log

    // Setup search button click event (backup)
    const searchBtn = document.querySelector('button[onclick="performSearch()"]');
    if (searchBtn) {
        console.log('Search button found'); // Debug log
    } else {
        console.log('Search button not found'); // Debug log
    }

    // Search dengan URL parameter (Enter key)
    const searchInput = document.getElementById('searchKategori');
    if (searchInput) {
        searchInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                console.log('Enter key pressed'); // Debug log
                performSearch();
            }
        });
    } else {
        console.log('Search input not found'); // Debug log
    }

    // Animate cards on page load
    const cards = document.querySelectorAll('.card');
    cards.forEach((card, index) => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(20px)';
        setTimeout(() => {
            card.style.transition = 'all 0.5s ease';
            card.style.opacity = '1';
            card.style.transform = 'translateY(0)';
        }, index * 100);
    });
});
</script>
@endpush

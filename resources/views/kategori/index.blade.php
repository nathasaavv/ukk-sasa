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

    <div class="cards">
        <div class="card">
            <div class="card-header">
                <div class="card-icon blue">📁</div>
            </div>
            <h3>Total Kategori</h3>
            <div class="card-value">{{ $kategori->count() }}</div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="card-icon green">💬</div>
            </div>
            <h3>Total Aspirasi</h3>
            <div class="card-value">{{ $kategori->sum('aspirasi_count') ?? 0 }}</div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="card-icon yellow">⚡</div>
            </div>
            <h3>Kategori Aktif</h3>
            <div class="card-value">{{ $kategori->where('status',1)->count() }}</div>
        </div>
    </div>

    <div class="table-container">
        <div class="table-header">
            <h2 class="table-title">Daftar Kategori</h2>
            <div class="table-actions">
                <div style="display:flex;gap:10px;align-items:center;">
                    <div class="search-box">
                        <input type="text"
                               placeholder="Cari kategori..."
                               id="searchKategori"
                               value="{{ request('search') }}">
                    </div>
                    <button type="button"
                            class="btn btn-primary"
                            onclick="
                                const searchTerm = document.getElementById('searchKategori').value;
                                const statusFilter = document.getElementById('filterStatus').value;
                                let url = '{{ route('kategori.index') }}';
                                const params = new URLSearchParams();
                                if (searchTerm.trim()) {
                                    params.append('search', searchTerm.trim());
                                }
                                if (statusFilter) {
                                    params.append('status', statusFilter);
                                }
                                if (params.toString()) {
                                    url += '?' + params.toString();
                                }
                                window.location.href = url;
                            "
                            style="padding:8px 16px;font-size:14px;">
                        <span>Cari</span>
                    </button>
                </div>
                <select class="form-control"
                        style="width:150px;"
                        id="filterStatus"
                        onchange="window.location.href='{{ route('kategori.index') }}?status=' + this.value + (document.getElementById('searchKategori').value ? '&search=' + document.getElementById('searchKategori').value : '')">
                    <option value="">Semua Status</option>
                    <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Aktif</option>
                    <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Tidak Aktif</option>
                </select>
            </div>
        </div>

        <div class="table-wrapper">
            <table id="kategoriTable">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Kategori</th>
                        <th>Keterangan</th>
                        <th>Jumlah Aspirasi</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($kategori as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <div style="display:flex;align-items:center;gap:10px;">
                                <div class="card-icon blue" style="width:36px;height:36px;font-size:16px;">📁</div>
                                <strong>{{ $item->nama }}</strong>
                            </div>
                        </td>
                        <td>
                            <span class="text-muted" style="font-size:13px;">
                                {{ Str::limit($item->ket_kategori ?? 'Tidak ada keterangan', 50) }}
                            </span>
                        </td>
                        <td>
                            <span class="badge {{ $item->aspirasi_count ?? 0 > 0 ? 'done' : 'pending' }}">
                                {{ $item->aspirasi_count ?? 0 }} aspirasi
                            </span>
                        </td>
                        <td>
                            <span class="badge {{ $item->status ? 'done' : 'pending' }}">
                                {{ $item->status ? 'Aktif' : 'Tidak Aktif' }}
                            </span>
                        </td>
                        <td>
                            <div style="display:flex;gap:6px;">
                                <a href="{{ route('kategori.show', $item->id) }}"
                                   class="btn btn-sm btn-primary"
                                   title="Lihat Detail">
                                    <span>Lihat</span>
                                </a>
                                <a href="{{ route('kategori.edit', $item->id) }}"
                                   class="btn btn-sm btn-warning"
                                   title="Edit Kategori">
                                    <span>Edit</span>
                                </a>
                                <form action="{{ route('kategori.destroy', $item->id) }}"
                                      method="POST"
                                      style="display:inline;"
                                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            class="btn btn-sm btn-danger"
                                            title="Hapus Kategori">
                                        <span>Hapus</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6">
                            <div class="empty-state">
                                <div class="empty-icon">📂</div>
                                <h3 class="empty-title">Belum ada kategori</h3>
                                <p class="empty-description">Mulai dengan menambahkan kategori pertama</p>
                                <a href="{{ route('kategori.create') }}" class="btn btn-primary">
                                    <span>➕</span>
                                    <span>Tambah Kategori</span>
                                </a>
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

@extends('layouts.app')

@section('title', 'Dashboard')

@section('header')
    <h1>Dashboard</h1>
@endsection

@section('header-actions')
    <a href="#" class="btn btn-primary">
        <span>➕</span>
        <span>Buat Aspirasi</span>
    </a>
@endsection

@section('content')
    <!-- Flash Messages -->
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

    <!-- Statistics Cards -->
    <div class="cards">
        <div class="card">
            <div class="card-header">
                <div class="card-icon blue">📊</div>
            </div>
            <h3>Total Aspirasi</h3>
            <div class="card-value">120</div>
            <div class="card-change positive">
                <span>↑</span>
                <span>12% dari bulan lalu</span>
            </div>
        </div>
        
        <div class="card">
            <div class="card-header">
                <div class="card-icon yellow">⏳</div>
            </div>
            <h3>Menunggu</h3>
            <div class="card-value">35</div>
            <div class="card-change negative">
                <span>↑</span>
                <span>5 dari kemarin</span>
            </div>
        </div>
        
        <div class="card">
            <div class="card-header">
                <div class="card-icon green">✅</div>
            </div>
            <h3>Selesai</h3>
            <div class="card-value">85</div>
            <div class="card-change positive">
                <span>↑</span>
                <span>8% peningkatan</span>
            </div>
        </div>
        
        <div class="card">
            <div class="card-header">
                <div class="card-icon purple">👥</div>
            </div>
            <h3>Total Siswa</h3>
            <div class="card-value">540</div>
            <div class="card-change positive">
                <span>↑</span>
                <span>2% pertumbuhan</span>
            </div>
        </div>
    </div>

    <!-- Recent Aspirations Table -->
    <div class="table-container">
        <div class="table-header">
            <h2 class="table-title">Aspirasi Terbaru</h2>
            <div class="table-actions">
                <div class="search-box">
                    <input type="text" placeholder="Cari aspirasi..." id="searchAspirasi">
                </div>
                <select class="form-control" style="width:150px;">
                    <option>Semua Status</option>
                    <option>Menunggu</option>
                    <option>Proses</option>
                    <option>Selesai</option>
                </select>
            </div>
        </div>
        
        <div class="table-wrapper">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody id="aspirasiTableBody">
                    <tr>
                        <td>1</td>
                        <td>
                            <div style="display:flex;align-items:center;gap:8px;">
                                <div class="avatar" style="width:32px;height:32px;font-size:12px;">A</div>
                                <span>Andi Pratama</span>
                            </div>
                        </td>
                        <td><strong>Perbaikan WC Lantai 2</strong></td>
                        <td><span class="badge done">Fasilitas</span></td>
                        <td><span class="badge pending">Menunggu</span></td>
                        <td>15 Jan 2026</td>
                        <td>
                            <div style="display:flex;gap:6px;">
                                <a href="#" class="btn btn-sm btn-primary">Lihat</a>
                                <a href="#" class="btn btn-sm btn-warning">Edit</a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>
                            <div style="display:flex;align-items:center;gap:8px;">
                                <div class="avatar" style="width:32px;height:32px;font-size:12px;">S</div>
                                <span>Siti Nurhaliza</span>
                            </div>
                        </td>
                        <td><strong>Kantin Sehat dan Bersih</strong></td>
                        <td><span class="badge done">Lingkungan</span></td>
                        <td><span class="badge done">Selesai</span></td>
                        <td>14 Jan 2026</td>
                        <td>
                            <div style="display:flex;gap:6px;">
                                <a href="#" class="btn btn-sm btn-primary">Lihat</a>
                                <a href="#" class="btn btn-sm btn-success">Detail</a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>
                            <div style="display:flex;align-items:center;gap:8px;">
                                <div class="avatar" style="width:32px;height:32px;font-size:12px;">R</div>
                                <span>Rizki Ahmad</span>
                            </div>
                        </td>
                        <td><strong>Tambah Ekstrakurikuler Robotika</strong></td>
                        <td><span class="badge processing">Kegiatan</span></td>
                        <td><span class="badge processing">Proses</span></td>
                        <td>13 Jan 2026</td>
                        <td>
                            <div style="display:flex;gap:6px;">
                                <a href="#" class="btn btn-sm btn-primary">Lihat</a>
                                <a href="#" class="btn btn-sm btn-warning">Edit</a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>
                            <div style="display:flex;align-items:center;gap:8px;">
                                <div class="avatar" style="width:32px;height:32px;font-size:12px;">D</div>
                                <span>Diana Putri</span>
                            </div>
                        </td>
                        <td><strong>Prestasi Olimpiade Matematika</strong></td>
                        <td><span class="badge done">Prestasi</span></td>
                        <td><span class="badge done">Selesai</span></td>
                        <td>12 Jan 2026</td>
                        <td>
                            <div style="display:flex;gap:6px;">
                                <a href="#" class="btn btn-sm btn-primary">Lihat</a>
                                <a href="#" class="btn btn-sm btn-success">Detail</a>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>
                            <div style="display:flex;align-items:center;gap:8px;">
                                <div class="avatar" style="width:32px;height:32px;font-size:12px;">B</div>
                                <span>Budi Santoso</span>
                            </div>
                        </td>
                        <td><strong>Program Beasiswa Prestasi</strong></td>
                        <td><span class="badge done">Program</span></td>
                        <td><span class="badge pending">Menunggu</span></td>
                        <td>11 Jan 2026</td>
                        <td>
                            <div style="display:flex;gap:6px;">
                                <a href="#" class="btn btn-sm btn-primary">Lihat</a>
                                <a href="#" class="btn btn-sm btn-warning">Edit</a>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="cards" style="margin-top:30px;">
        <div class="card">
            <h3>📝 Buat Aspirasi Baru</h3>
            <p style="color:#64748b;font-size:14px;margin:15px 0;">Tambahkan aspirasi baru dari siswa</p>
            <a href="#" class="btn btn-primary">Buat Sekarang</a>
        </div>
        
        <div class="card">
            <h3>📁 Kelola Kategori</h3>
            <p style="color:#64748b;font-size:14px;margin:15px 0;">Atur kategori aspirasi</p>
            <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Kelola</a>
        </div>
        
        <div class="card">
            <h3>📊 Laporan Bulanan</h3>
            <p style="color:#64748b;font-size:14px;margin:15px 0;">Download laporan bulanan</p>
            <a href="#" class="btn btn-success">Download</a>
        </div>
    </div>
@endsection

@push('scripts')
<script>
// Search functionality for aspirasi table
document.getElementById('searchAspirasi').addEventListener('input', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    const rows = document.querySelectorAll('#aspirasiTableBody tr');
    
    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(searchTerm) ? '' : 'none';
    });
});

// Animate numbers on page load
function animateValue(element, start, end, duration) {
    const range = end - start;
    const increment = range / (duration / 16);
    let current = start;
    
    const timer = setInterval(() => {
        current += increment;
        if ((increment > 0 && current >= end) || (increment < 0 && current <= end)) {
            element.textContent = end;
            clearInterval(timer);
        } else {
            element.textContent = Math.floor(current);
        }
    }, 16);
}

// Animate card values on page load
document.addEventListener('DOMContentLoaded', function() {
    const cardValues = document.querySelectorAll('.card-value');
    cardValues.forEach(element => {
        const finalValue = parseInt(element.textContent);
        if (!isNaN(finalValue)) {
            animateValue(element, 0, finalValue, 1000);
        }
    });
});
</script>
@endpush

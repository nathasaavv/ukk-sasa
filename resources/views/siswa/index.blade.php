@extends('layouts.app')


@section('header-actions')
    <a href="#" class="btn btn-primary">
        <span>➕</span>
        <span>Buat Aspirasi</span>
    </a>
@endsection



@section('title', 'Siswa Dashboard')

@section('content')
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

@endsection

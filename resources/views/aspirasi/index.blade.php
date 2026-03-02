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
                    @foreach ($aspirasis as $index => $aspirasi)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            <div style="display:flex;align-items:center;gap:8px;">
                                <div class="avatar" style="width:32px;height:32px;font-size:12px;">{{ strtoupper(substr($aspirasi->user->name ?? 'A', 0, 1)) }}</div>
                                <span>{{ $aspirasi->user->name ?? 'Unknown' }}</span>
                            </div>
                        </td>
                        <td><strong>{{ $aspirasi->feedback }}</strong></td>
                        <td><span class="badge done">{{ $aspirasi->kategori->nama }}</span></td>
                        <td><span class="badge pending">{{ $aspirasi->status }}</span></td>
                        <td>{{ $aspirasi->created_at->format('d M Y') }}   </td>
                        <td>
                            <div style="display:flex;gap:6px;">
                                <a href="{{ route('aspirasi.show', $aspirasi->id) }}" class="btn btn-sm btn-primary">Lihat</a>
                                <a href="{{ route('aspirasi.edit', $aspirasi->id) }}" class="btn btn-sm btn-warning">Edit</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </div>
    </div>

@endsection

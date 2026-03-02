@extends('layouts.app')

@section('title', 'Detail Aspirasi')

@section('header')
    <div style="display:flex;align-items:center;gap:15px;">
        <a href="{{ route('aspirasi.index') }}" class="btn btn-secondary">
            <span>←</span>
            <span>Kembali</span>
        </a>
        <h1>Detail Aspirasi</h1>
    </div>
@endsection

@section('header-actions')
    <div style="display:flex;gap:8px;">
        <a href="{{ route('aspirasi.edit', $aspirasi->id) }}" class="btn btn-primary">
            <span>✏️</span>
            <span>Edit</span>
        </a>
        
    </div>
@endsection

@section('content')
<div style="display:grid;grid-template-columns:1fr 320px;gap:30px;">

    <!-- Main Content -->
    <div>
        <!-- User Info Card -->
        <div class="card" style="margin-bottom:20px;">
            <div style="display:flex;align-items:center;gap:15px;">
                <div class="avatar" style="width:48px;height:48px;font-size:18px;background:#3b82f6;">
                    {{ strtoupper(substr($aspirasi->user->name ?? 'A', 0, 1)) }}
                </div>
                <div>
                    <h3 style="margin:0;font-size:16px;color:#1f2937;">{{ $aspirasi->user->name ?? 'Unknown' }}</h3>
                    <p class="text-muted" style="margin:0;font-size:13px;">
                        {{ $aspirasi->created_at->format('d F Y, H:i') }}
                    </p>
                </div>
            </div>
        </div>

        <!-- Aspirasi Content -->
        <div class="card">
            <div style="margin-bottom:20px;">
                <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:15px;">
                    <h2 style="margin:0;font-size:18px;color:#1f2937;">Aspirasi</h2>
                    <span class="badge {{ $aspirasi->status == 'Menunggu' ? 'pending' : ($aspirasi->status == 'Proses' ? 'warning' : 'success') }}">
                        {{ $aspirasi->status }}
                    </span>
                </div>
                
                <div style="margin-bottom:15px;">
                    <small class="text-muted" style="font-weight:500;">KATEGORI</small>
                    <div style="margin-top:5px;">
                        <span class="badge done">{{ $aspirasi->kategori->nama }}</span>
                    </div>
                </div>
            </div>

            <div style="background:#f8fafc;padding:20px;border-radius:8px;border-left:4px solid #3b82f6;">
                <p style="margin:0;line-height:1.6;color:#374151;white-space:pre-wrap;">{{ $aspirasi->feedback }}</p>
            </div>
        </div>
    </div>

    <!-- Sidebar -->
    <div>
        <!-- Status Info -->
        <div class="card" style="background:#f8fafc;border:1px solid #e6eef6;margin-bottom:18px;">
            <h3 style="font-size:15px;margin-bottom:12px;">Informasi Status</h3>
            <div style="display:flex;flex-direction:column;gap:10px;">
                <div style="display:flex;justify-content:space-between;align-items:center;">
                    <span class="text-muted" style="font-size:13px;">Status Saat Ini:</span>
                    <span class="badge {{ $aspirasi->status == 'Menunggu' ? 'pending' : ($aspirasi->status == 'Proses' ? 'warning' : 'success') }}">
                        {{ $aspirasi->status }}
                    </span>
                </div>
                <div style="display:flex;justify-content:space-between;align-items:center;">
                    <span class="text-muted" style="font-size:13px;">Dibuat:</span>
                    <span style="font-size:13px;font-weight:500;">{{ $aspirasi->created_at->format('d M Y') }}</span>
                </div>
                @if($aspirasi->updated_at != $aspirasi->created_at)
                <div style="display:flex;justify-content:space-between;align-items:center;">
                    <span class="text-muted" style="font-size:13px;">Diperbarui:</span>
                    <span style="font-size:13px;font-weight:500;">{{ $aspirasi->updated_at->format('d M Y') }}</span>
                </div>
                @endif
            </div>
        </div>

        <!-- Actions Card -->
        <div class="card" style="background:#f8fafc;border:1px solid #e6eef6;margin-bottom:18px;">
            <h3 style="font-size:15px;margin-bottom:12px;">Aksi Cepat</h3>
            <div style="display:flex;flex-direction:column;gap:10px;">
                <a href="{{ route('aspirasi.edit', $aspirasi->id) }}" class="btn btn-primary" style="width:100%;justify-content:center;">
                    <span>✏️</span>
                    <span>Edit Aspirasi</span>
                </a>
                
            </div>
        </div>

        <!-- Tips Card -->
        <div class="card">
            <h3 style="font-size:15px;margin-bottom:10px;">💡 Tips</h3>
            <ul style="list-style:none;color:#0f172a;font-size:13px;line-height:1.6;margin:0;padding:0;">
                <li style="margin-bottom:8px;">• Aspirasi dapat diedit selama status masih <strong>Menunggu</strong>.</li>
                <li style="margin-bottom:8px;">• Perubahan status akan diberitahukan melalui notifikasi.</li>
                <li>• Hubungi admin sekolah untuk informasi lebih lanjut.</li>
            </ul>
        </div>
    </div>

</div>
@endsection
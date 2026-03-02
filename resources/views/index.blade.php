@extends('layouts.app')

@section('title', 'Dashboard')

@section('header')
    <h1>Dashboard</h1>
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




    <div class="cards" style="margin-top:30px;">
        <div class="card">
            <h3>📝 Buat Aspirasi Baru</h3>
            <p class="text-muted" style="font-size:14px;margin:15px 0;">Tambahkan aspirasi baru dari siswa</p>
            <a href="#" class="btn btn-primary">Buat Sekarang</a>
        </div>

        <div class="card">
            <h3>📁 Kelola Kategori</h3>
            <p class="text-muted" style="font-size:14px;margin:15px 0;">Atur kategori aspirasi</p>
            <a href="{{ route('kategori.index') }}" class="btn btn-secondary">Kelola</a>
        </div>

        <div class="card">
            <h3>📊 Laporan Bulanan</h3>
            <p class="text-muted" style="font-size:14px;margin:15px 0;">Download laporan bulanan</p>
            <a href="#" class="btn btn-success">Download</a>
        </div>
    </div>
@endsection

@push('scripts')
<script>

document.getElementById('searchAspirasi').addEventListener('input', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    const rows = document.querySelectorAll('#aspirasiTableBody tr');

    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(searchTerm) ? '' : 'none';
    });
});


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

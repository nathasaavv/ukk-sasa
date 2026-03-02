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

    <div class="flex flex-wrap gap-6 items-stretch">
        <div class="card-dark w-full sm:w-1/2 md:w-1/3 lg:w-1/4">
            <div class="flex items-start justify-between">
                <div>
                    <h3 class="text-sm font-semibold text-gray-200">Total Aspirasi</h3>
                    <div class="card-value text-2xl font-bold mt-3">120</div>
                    <div class="text-sm text-gray-400 mt-2">↑ 12% dari bulan lalu</div>
                </div>
                <div class="w-12 h-12 rounded-lg bg-green-primary flex items-center justify-center text-white text-lg">📊</div>
            </div>
        </div>

        <div class="card-dark w-full sm:w-1/2 md:w-1/3 lg:w-1/4">
            <div class="flex items-start justify-between">
                <div>
                    <h3 class="text-sm font-semibold text-gray-200">Menunggu</h3>
                    <div class="card-value text-2xl font-bold mt-3">35</div>
                    <div class="text-sm text-gray-400 mt-2">↑ 5 dari kemarin</div>
                </div>
                <div class="w-12 h-12 rounded-lg bg-yellow-400 flex items-center justify-center text-black text-lg">⏳</div>
            </div>
        </div>

        <div class="card-dark w-full sm:w-1/2 md:w-1/3 lg:w-1/4">
            <div class="flex items-start justify-between">
                <div>
                    <h3 class="text-sm font-semibold text-gray-200">Selesai</h3>
                    <div class="card-value text-2xl font-bold mt-3">85</div>
                    <div class="text-sm text-gray-400 mt-2">↑ 8% peningkatan</div>
                </div>
                <div class="w-12 h-12 rounded-lg bg-green-secondary flex items-center justify-center text-white text-lg">✅</div>
            </div>
        </div>

  <!-- ===== DASHBOARD EXTRA SECTION ===== -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6 mt-8">

    <!-- Welcome Card -->
    <div class="card-dark col-span-1 p-6">
        <h2 class="text-lg font-semibold text-white mb-2">
            👋 Selamat Datang
        </h2>
        <p class="text-gray-400 text-sm">
            Pantau aspirasi siswa secara real-time. 
            Sistem akan membantu memonitor laporan yang masuk dan progres penyelesaian.
        </p>

        <div class="mt-4">
            <a href="#" class="bg-green-primary px-4 py-2 rounded-lg text-white text-sm hover:opacity-80 transition">
                + Buat Aspirasi
            </a>
        </div>
    </div>

    <!-- Progress Status -->
    <div class="card-dark col-span-1 p-6">
        <h2 class="text-lg font-semibold text-white mb-4">
            📊 Progress Aspirasi
        </h2>

        <div class="space-y-4">

            <div>
                <div class="flex justify-between text-sm text-gray-300 mb-1">
                    <span>Selesai</span>
                    <span>70%</span>
                </div>
                <div class="w-full bg-gray-700 rounded-full h-2">
                    <div class="bg-green-secondary h-2 rounded-full" style="width:70%"></div>
                </div>
            </div>

            <div>
                <div class="flex justify-between text-sm text-gray-300 mb-1">
                    <span>Menunggu</span>
                    <span>30%</span>
                </div>
                <div class="w-full bg-gray-700 rounded-full h-2">
                    <div class="bg-yellow-400 h-2 rounded-full" style="width:30%"></div>
                </div>
            </div>

        </div>
    </div>

    <!-- Mini Chart -->
    <div class="card-dark col-span-1 p-6">
        <h2 class="text-lg font-semibold text-white mb-4">
            📈 Statistik Mingguan
        </h2>

        <div class="flex items-end gap-2 h-32">
            <div class="bg-green-primary w-6 rounded" style="height:40%"></div>
            <div class="bg-green-primary w-6 rounded" style="height:65%"></div>
            <div class="bg-green-primary w-6 rounded" style="height:30%"></div>
            <div class="bg-green-primary w-6 rounded" style="height:80%"></div>
            <div class="bg-green-primary w-6 rounded" style="height:55%"></div>
            <div class="bg-green-primary w-6 rounded" style="height:70%"></div>
            <div class="bg-green-primary w-6 rounded" style="height:90%"></div>
        </div>

        <p class="text-xs text-gray-400 mt-3">
            Aktivitas aspirasi 7 hari terakhir
        </p>
    </div>

</div>


<!-- Recent Activity -->
<div class="card-dark mt-8 p-6">
    <h2 class="text-lg font-semibold text-white mb-4">
        🕒 Aktivitas Terbaru
    </h2>

    <div class="space-y-4 text-sm">

        <div class="flex justify-between border-b border-gray-700 pb-2">
            <span class="text-gray-300">Aspirasi baru ditambahkan</span>
            <span class="text-gray-500">2 menit lalu</span>
        </div>

        <div class="flex justify-between border-b border-gray-700 pb-2">
            <span class="text-gray-300">Status aspirasi diperbarui</span>
            <span class="text-gray-500">10 menit lalu</span>
        </div>

        <div class="flex justify-between border-b border-gray-700 pb-2">
            <span class="text-gray-300">Admin memberikan tanggapan</span>
            <span class="text-gray-500">1 jam lalu</span>
        </div>

        <div class="flex justify-between">
            <span class="text-gray-300">Aspirasi selesai diproses</span>
            <span class="text-gray-500">Kemarin</span>
        </div>

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

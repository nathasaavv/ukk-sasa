@extends('layouts.app')

@section('title', 'Dashboard')

@section('header')
    <h1>Dashboard</h1>
@endsection



@section('content')
    <div class="space-y-6 sm:space-y-8">
        <!-- Stats Row -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-6">
            <!-- Total Card -->
            <div class="card-dark group hover:border-green-primary transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-10 h-10 rounded-xl bg-green-primary/10 flex items-center justify-center text-green-primary border border-green-primary/20 group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </div>
                </div>
                <h3 class="text-gray-400 text-xs font-medium">Total Aspirasi</h3>
                <div class="text-3xl font-bold text-white mt-1 card-value">{{ $totalAspirasi }}</div>
                <div class="mt-2 flex items-center gap-1">
                    <span class="text-[10px] text-green-primary font-bold">Total Laporan</span>
                </div>
            </div>

            <!-- Menunggu Card -->
            <div class="card-dark group hover:border-yellow-500/50 transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-10 h-10 rounded-xl bg-yellow-500/10 flex items-center justify-center text-yellow-500 border border-yellow-500/20 group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m9-3a9 9 0 11-3-6.7M21 3v6h-6" />
                        </svg>
                    </div>
                </div>
                <h3 class="text-gray-400 text-xs font-medium">Menunggu</h3>
                <div class="text-3xl font-bold text-white mt-1 card-value">{{ $menunggu }}</div>
                <div class="mt-2 flex items-center gap-1">
                    <span class="text-[10px] text-yellow-500/80 font-bold">Butuh Respon</span>
                </div>
            </div>

            <!-- Diproses Card -->
            <div class="card-dark group hover:border-orange-500/50 transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-10 h-10 rounded-xl bg-orange-500/10 flex items-center justify-center text-orange-500 border border-orange-500/20 group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                    </div>
                </div>
                <h3 class="text-gray-400 text-xs font-medium">Diproses</h3>
                <div class="text-3xl font-bold text-white mt-1 card-value">{{ $diproses }}</div>
                <div class="mt-2 flex items-center gap-1">
                    <span class="text-[10px] text-orange-500/80 font-bold">Sedang Dikerjakan</span>
                </div>
            </div>

            <!-- Selesai Card -->
            <div class="card-dark group hover:border-blue-500/50 transition-all duration-300">
                <div class="flex items-center justify-between mb-4">
                    <div class="w-10 h-10 rounded-xl bg-blue-500/10 flex items-center justify-center text-blue-500 border border-blue-500/20 group-hover:scale-110 transition-transform">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
                <h3 class="text-gray-400 text-xs font-medium">Selesai</h3>
                <div class="text-3xl font-bold text-white mt-1 card-value">{{ $selesai }}</div>
                <div class="mt-2 flex items-center gap-1">
                    <span class="text-[10px] text-blue-500/80 font-bold">Telah Selesai</span>
                </div>
            </div>

         
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Welcome Column -->
            <div class="lg:col-span-1 space-y-6">
                <!-- Welcome Card -->
                <div class="card-dark p-6 bg-gradient-to-br from-gray-800 to-gray-900 border-none shadow-xl">
                    <div class="flex items-center gap-4 mb-6">
                        <div class="w-12 h-12 rounded-full bg-green-primary flex items-center justify-center text-xl shadow-lg shadow-green-500/20">
                            👋
                        </div>
                        <div>
                            <h2 class="text-xl font-bold text-white">Hi, {{ auth()->user()->name }}!</h2>
                            <p class="text-xs text-gray-400">Selamat datang kembali di SISPA.</p>
                        </div>
                    </div>
                    <p class="text-sm text-gray-300 leading-relaxed">
                        {{ auth()->user()->role === 'admin' 
                            ? 'Kamu memiliki ' . $menunggu . ' aspirasi yang menunggu untuk segera ditindaklanjuti.' 
                            : 'Pantau terus progres aspirasi yang kamu kirimkan secara real-time di sini.' }}
                    </p>
                    <div class="mt-6">
                        <a href="{{ route('aspirasi.index') }}" class="btn-primary w-full text-center py-2.5 rounded-xl text-sm font-bold inline-block">
                            {{ auth()->user()->role === 'admin' ? 'Kelola Aspirasi' : 'Kirim Aspirasi Baru' }}
                        </a>
                    </div>
                </div>

                <!-- Progress Column -->
                <div class="card-dark p-6">
                    <h2 class="text-lg font-bold text-white mb-6 flex items-center gap-2">
                        <span class="w-1.5 h-6 bg-green-primary rounded-full"></span>
                        Progress Overview
                    </h2>

                    <div class="space-y-6">
                        <!-- Selesai Progress -->
                        <div class="space-y-2">
                            <div class="flex justify-between text-xs font-bold">
                                <span class="text-blue-400 uppercase">Selesai</span>
                                <span class="text-white">{{ $persentaseSelesai }}%</span>
                            </div>
                            <div class="w-full bg-gray-800 rounded-full h-1.5 overflow-hidden">
                                <div class="bg-blue-500 h-full rounded-full transition-all duration-1000" style="width:{{ $persentaseSelesai }}%"></div>
                            </div>
                        </div>

                        <!-- Diproses Progress -->
                        <div class="space-y-2">
                            <div class="flex justify-between text-xs font-bold">
                                <span class="text-orange-400 uppercase">Diproses</span>
                                <span class="text-white">{{ $persentaseDiproses }}%</span>
                            </div>
                            <div class="w-full bg-gray-800 rounded-full h-1.5 overflow-hidden">
                                <div class="bg-orange-500 h-full rounded-full transition-all duration-1000" style="width:{{ $persentaseDiproses }}%"></div>
                            </div>
                        </div>

                        <!-- Menunggu Progress -->
                        <div class="space-y-2">
                            <div class="flex justify-between text-xs font-bold">
                                <span class="text-yellow-500 uppercase">Menunggu</span>
                                <span class="text-white">{{ $persentaseMenunggu }}%</span>
                            </div>
                            <div class="w-full bg-gray-800 rounded-full h-1.5 overflow-hidden">
                                <div class="bg-yellow-500 h-full rounded-full transition-all duration-1000" style="width:{{ $persentaseMenunggu }}%"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Chart & Recent Column -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Weekly Chart -->
                <div class="card-dark p-6">
                    <div class="flex items-center justify-between mb-8">
                        <div>
                            <h2 class="text-lg font-bold text-white">Statistik Laporan</h2>
                            <p class="text-[10px] text-gray-500 uppercase tracking-widest font-bold">AKtivitas dalam 7 hari terakhir</p>
                        </div>
                    </div>

                    <div class="flex items-end justify-between gap-3 h-48 px-2">
                        @php
                            $maxValue = max($dataMingguan) > 0 ? max($dataMingguan) : 1;
                        @endphp
                        @foreach($dataMingguan as $index => $data)
                            <div class="flex-1 flex flex-col items-center gap-3 group relative h-full justify-end">
                                <div class="bg-green-primary w-full max-w-[40px] rounded-lg transition-all duration-500 shadow-lg shadow-green-500/20 relative" 
                                     style="height:{{ ($data / $maxValue) * 85 }}%">
                                     <div class="absolute -top-7 left-1/2 -translate-x-1/2 text-[10px] font-bold text-white bg-gray-800 px-1.5 py-0.5 rounded opacity-0 group-hover:opacity-100 transition-opacity">
                                        {{ $data }}
                                     </div>
                                </div>
                                <span class="text-[10px] text-gray-500 font-black uppercase">{{ $labelMingguan[$index] }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Recent Table -->
                <div class="card-dark p-6">
                    <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between mb-6 gap-4">
                        <div>
                            <h2 class="text-lg font-bold text-white">Aspirasi Terbaru</h2>
                            <p class="text-[10px] text-gray-500 font-bold uppercase tracking-wider">Aktivitas terkini</p>
                        </div>
                        <div class="relative w-full sm:w-48">
                            <input type="text" id="searchAspirasi" placeholder="Cari di tabel..." 
                                   class="w-full bg-gray-800/50 border border-gray-700 rounded-lg py-1.5 pl-8 pr-3 text-xs text-white focus:outline-none focus:border-green-primary transition-all">
                            <svg class="w-3.5 h-3.5 absolute left-2.5 top-1/2 -translate-y-1/2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                            </svg>
                        </div>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <tbody class="divide-y divide-gray-800/50" id="aspirasiTableBody">
                                @forelse($aspirasiTerbaru as $asp)
                                    <tr class="group transition-colors">
                                        <td class="py-4">
                                            <div class="flex items-center gap-3">
                                                <div class="w-9 h-9 rounded-xl bg-gray-800 flex items-center justify-center text-[10px] font-bold text-green-primary border border-gray-700 shadow-inner group-hover:border-green-primary/50 transition-colors">
                                                    {{ substr($asp->user->name, 0, 1) }}
                                                </div>
                                                <div>
                                                    <div class="text-[11px] font-bold text-white">{{ $asp->user->name }}</div>
                                                    <div class="text-[9px] text-gray-500 font-medium">{{ $asp->created_at->diffForHumans() }}</div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-4">
                                            <p class="text-[11px] text-gray-400 line-clamp-1 italic pr-4">"{{ $asp->feedback }}"</p>
                                        </td>
                                        <td class="py-4 text-right px-2">
                                            <span class="inline-block w-2 h-2 rounded-full border border-current {{ $asp->status === 'Selesai' ? 'text-blue-500' : ($asp->status === 'Diproses' ? 'text-orange-500' : 'text-yellow-500') }}"></span>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="3" class="py-12 text-center text-[11px] text-gray-500 font-bold uppercase tracking-widest bg-gray-800/20 rounded-xl">Belum ada aspirasi terbaru.</td>
                                    </tr>
                                @endforelse
                                <tr>
                                    <td colspan="3" class="pt-4 text-center">
                                       <button class="text-[10px] font-bold text-gray-600 hover:text-white transition-colors uppercase tracking-tighter">••• Load More •••</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
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

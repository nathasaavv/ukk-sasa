@extends('layouts.app')

@section('title', 'Detail Aspirasi')

@section('header')
<div class="flex items-center gap-4">
    <a href="{{ route('aspirasi.index') }}" class="btn-secondary inline-flex items-center gap-2">
        <span>←</span>
        <span>Kembali</span>
    </a>
    <h1 class="text-xl font-semibold">Detail Aspirasi</h1>
</div>
@endsection


@section('header-actions')
<div class="flex gap-2">
    <a href="{{ route('aspirasi.edit', $aspirasi->id) }}" class="btn-primary inline-flex items-center gap-2">
        <span>✏️</span>
        <span>Edit</span>
    </a>
</div>
@endsection


@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

    <!-- MAIN CONTENT -->
    <div class="lg:col-span-2 space-y-6">

        <!-- USER CARD -->
        <div class="card-dark p-5">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 rounded-full bg-blue-500 flex items-center justify-center text-white font-semibold text-lg">
                    {{ strtoupper(substr($aspirasi->user->name ?? 'A', 0, 1)) }}
                </div>

                <div>
                    <h3 class="text-gray-100 font-semibold">
                        {{ $aspirasi->user->name ?? 'Unknown' }}
                    </h3>
                    <p class="text-gray-400 text-sm">
                        {{ $aspirasi->created_at->format('d F Y, H:i') }}
                    </p>
                </div>
            </div>
        </div>


        <!-- ASPIRASI CONTENT -->
        <div class="card-dark p-6">

            <div class="flex justify-between items-center mb-5">
                <h2 class="text-lg font-semibold text-gray-100">Aspirasi</h2>

                <span class="badge {{ $aspirasi->status == 'Menunggu'
                    ? 'pending'
                    : ($aspirasi->status == 'Proses' ? 'warning' : 'success') }}">
                    {{ $aspirasi->status }}
                </span>
            </div>

            <!-- KATEGORI -->
            <div class="mb-6">
                <p class="text-xs text-gray-400 font-semibold tracking-wide">
                    KATEGORI
                </p>

                <div class="mt-2">
                    <span class="badge done">
                        {{ $aspirasi->kategori->nama }}
                    </span>
                </div>
            </div>

            <!-- ISI -->
         <div class="bg-gray-800/60 border border-gray-700 p-5 rounded-lg border-l-4 border-blue-500">
    <p class="text-gray-200 leading-relaxed whitespace-pre-wrap">
        {{ $aspirasi->feedback }}
    </p>
</div>

        </div>
    </div>


    <!-- SIDEBAR -->
    <aside class="space-y-6">

        <!-- STATUS INFO -->
        <div class="card-dark p-5">
            <h3 class="text-sm font-semibold text-gray-100 mb-4">
                Informasi Status
            </h3>

            <div class="space-y-3 text-sm">

                <div class="flex justify-between">
                    <span class="text-gray-400">Status Saat Ini:</span>
                    <span class="badge {{ $aspirasi->status == 'Menunggu'
                        ? 'pending'
                        : ($aspirasi->status == 'Proses' ? 'warning' : 'success') }}">
                        {{ $aspirasi->status }}
                    </span>
                </div>

                <div class="flex justify-between">
                    <span class="text-gray-400">Dibuat:</span>
                    <span class="text-gray-200 font-medium">
                        {{ $aspirasi->created_at->format('d M Y') }}
                    </span>
                </div>

                @if($aspirasi->updated_at != $aspirasi->created_at)
                <div class="flex justify-between">
                    <span class="text-gray-400">Diperbarui:</span>
                    <span class="text-gray-200 font-medium">
                        {{ $aspirasi->updated_at->format('d M Y') }}
                    </span>
                </div>
                @endif

            </div>
        </div>


        <!-- QUICK ACTION -->
        <div class="card-dark p-5">
            <h3 class="text-sm font-semibold text-gray-100 mb-4">
                Aksi Cepat
            </h3>

            <a href="{{ route('aspirasi.edit', $aspirasi->id) }}"
               class="btn-primary w-full justify-center inline-flex items-center gap-2">
                <span>✏️</span>
                <span>Edit Aspirasi</span>
            </a>
        </div>


        <!-- TIPS -->
        <div class="card-dark p-5">
            <h3 class="text-sm font-semibold text-gray-100 mb-3">
                💡 Tips
            </h3>

            <ul class="text-sm text-gray-300 space-y-2 list-disc list-inside">
                <li>Aspirasi dapat diedit selama status masih <strong>Menunggu</strong>.</li>
                <li>Perubahan status akan diberitahukan melalui notifikasi.</li>
                <li>Hubungi admin sekolah untuk informasi lebih lanjut.</li>
            </ul>
        </div>

    </aside>

</div>
@endsection
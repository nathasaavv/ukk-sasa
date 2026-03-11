@extends('layouts.app')

@section('header')
    <h1 class="text-2xl font-semibold">Manajemen User</h1>
@endsection

@section('content')
<div class="flex flex-col lg:flex-row lg:items-center lg:justify-between mb-8 gap-6">
    <!-- Form Import & Actions Wrapper -->
    <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-4 w-full lg:w-auto">
        <!-- Form Import -->
        <form action="{{ route('siswa.import') }}" method="POST" enctype="multipart/form-data"
              class="flex flex-1 flex-col sm:flex-row items-center gap-3 bg-dark-surface p-2 px-3 rounded-xl border border-gray-800 shadow-sm transition-all hover:border-gray-700 w-full sm:w-auto">
            @csrf
            <div class="w-full sm:w-auto overflow-hidden">
                <input type="file" name="file" 
                    class="text-xs sm:text-sm text-gray-400 w-full
                    file:mr-3 file:py-2 file:px-4
                    file:rounded-lg file:border-0
                    file:text-xs file:font-semibold
                    file:bg-green-500/10 file:text-green-400
                    hover:file:bg-green-500/20
                    file:transition-all
                    cursor-pointer focus:outline-none">
            </div>
            <button type="submit" class="w-full sm:w-auto px-6 py-2 bg-green-600 hover:bg-green-700 text-white text-sm font-bold rounded-lg transition-all shadow-lg shadow-green-900/20">
                Import
            </button>
        </form>

        <!-- Divider for mobile visually -->
        <div class="hidden sm:block h-8 w-px bg-gray-800 mx-2"></div>

        <!-- Button Tambah User -->
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary flex items-center justify-center gap-2 px-6 py-3 shadow-lg shadow-green-500/20">
            <span>➕</span>
            <span>Tambah User</span>
        </a>
    </div>
</div>

    @if(session('success'))
        <div class="alert alert-success mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="overflow-x-auto card-dark">
        <table class="min-w-full table-auto text-left">
            <thead>
                <tr class="text-sm text-gray-400 border-b border-gray-700">
                    <th class="px-6 py-3">#</th>
                    <th class="px-6 py-3">Nama</th>
                    <th class="px-6 py-3">Email</th>
                    <th class="px-6 py-3">Terdaftar</th>
                    <th class="px-6 py-3">Status</th>
                    <th class="px-6 py-3">NIS</th>
                    <th class="px-6 py-3">Role</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-transparent divide-y divide-gray-700">
                @foreach($users as $user)
                    <tr class="hover:bg-gray-800">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-200">
                            {{ $loop->iteration + ($users->currentPage()-1) * $users->perPage() }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-200">{{ $user->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-200">{{ $user->email }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-200">
                            {{ optional($user->created_at)->format('d M Y') ?? '-' }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-200">{{ $user->status }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-200">{{ $user->nis }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-200">{{ $user->role }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-secondary">Edit</a>
                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" class="inline-block ml-2" onsubmit="confirmAction(event, 'Hapus user {{ $user->name }}? Pengguna ini tidak akan bisa login lagi.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $users->links() }}
    </div>
@endsection

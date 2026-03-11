<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Aspirasi Siswa')</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'dark-bg': '#0b1220',
                        'dark-surface': '#0f1724',
                        'dark-sidebar': '#071029',
                        'green-primary': '#10b981',
                        'green-secondary': '#059669',
                    },
                    fontFamily: {
                        'sans': ['Inter', 'ui-sans-serif', 'system-ui'],
                    },
                }
            }
        }
    </script>
</head>

<body class="bg-dark-bg text-gray-100 font-sans">
    <div class="flex">
        <!-- Mobile Sidebar Overlay -->
        <div id="sidebarOverlay" class="fixed inset-0 bg-black/50 z-40 hidden lg:hidden transition-opacity duration-300 backdrop-blur-sm" onclick="toggleSidebar()"></div>

        <!-- Sidebar -->
        <aside class="w-64 bg-dark-sidebar text-white p-5 fixed h-full overflow-y-auto z-50 -translate-x-full lg:translate-x-0 transition-all duration-300"
            id="sidebar">
            <!-- Logo -->
            <div class="flex items-center gap-3 mb-10">
                <div class="w-10 h-10 bg-green-primary rounded-lg flex items-center justify-center">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2L2 7v10c0 5.55 3.84 10.74 9 12 5.16-1.26 9-6.45 9-12V7l-10-5z" />
                    </svg>
                </div>
                <span class="text-xl font-bold">Aspirasi Siswa</span>
            </div>

            <!-- Main Menu -->
            <nav class="space-y-6">
                <div>
                    <h3 class="text-xs uppercase text-gray-400 font-semibold mb-3">Main Menu</h3>
                    <div class="space-y-2">
                        @if (auth()->user()->role === 'admin')
                            <a href="{{ route('dashboard.index') }}"
                                class="sidebar-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                                <span>Dashboard</span>
                            </a>
                        @endif
                        @if (auth()->user()->role === 'siswa')
                            <a href="{{ route('dashboard.siswa') }}"
                                class="sidebar-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                                </svg>
                                <span>Dashboard Siswa</span>
                            </a>
                        @endif
                        <a href="{{ route('aspirasi.index') }}"
                            class="sidebar-item {{ request()->routeIs('aspirasi.*') ? 'active' : '' }}">

                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 10h8M8 14h5m9 2a2 2 0 01-2 2H6l-4 4V6a2 2 0 012-2h16a2 2 0 012 2v10z" />
                            </svg>

                            <span>Aspirasi Siswa</span>
                        </a>

                        @if (auth()->user()->role === 'admin')
                            <a href="{{ route('kategori.index') }}"
                                class="sidebar-item {{ request()->routeIs('kategori.*') ? 'active' : '' }}">

                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M7 7h.01M3 11l8.586 8.586a2 2 0 002.828 0l6.172-6.172a2 2 0 000-2.828L11 2H4a1 1 0 00-1 1v7z" />
                                </svg>

                                <span>Kategori</span>
                            </a>
                        @endif

                        @if (auth()->user()->role === 'admin')
                            <a href="{{ route('admin.users.index') }}"
                                class="sidebar-item {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 12a5 5 0 100-10 5 5 0 000 10zm0 2c-4.418 0-8 2.239-8 5v1h16v-1c0-2.761-3.582-5-8-5z" />
                                </svg>
                                <span>Users</span>
                            </a>
                        @endif
                        @if (auth()->user()->role === 'admin')
                            <a href="{{ route('archive.index') }}" class="sidebar-item {{ request()->routeIs('archive.*') ? 'active' : '' }}">

                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none"
                                    viewBox="0 0 24 24" stroke="currentColor">

                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M4 7h16M4 7l1.5 10A2 2 0 007.5 19h9a2 2 0 002-2L20 7M9 11h6" />
                                </svg>

                                <span>Arsip Aspirasi</span>
                            </a>
                        @endif

                        {{-- <a href="{{ route('aktivitas.index') }}"
                        class="sidebar-item {{ request()->routeIs('aktivitas.*') ? 'active' : '' }}">
                        
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4l3 3m9-3a9 9 0 11-3-6.7M21 3v6h-6" />
                        </svg>

                        <span>Aktivitas</span>
                    </a> --}}
                    </div>
                </div>

                <div>
                </div>
    </div>
    </nav>

    </aside>

    <!-- Main Content -->
    <div class="lg:ml-64 flex-1 min-w-0 transition-all duration-300" id="mainContent">
        <!-- Header -->
        <header class="bg-dark-surface border-b border-gray-800 px-4 sm:px-8 py-4 sm:py-6">
            <div class="flex items-center justify-between gap-4">
                <div class="flex items-center gap-3">
                    <button class="lg:hidden p-2 -ml-2 text-gray-400 hover:text-white hover:bg-gray-800 rounded-lg transition-colors" onclick="toggleSidebar()">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <div class="min-w-0">
                        @yield('header')
                    </div>
                </div>

                <div class="flex items-center gap-2 sm:gap-4">
                    <!-- Search Bar (Hidden on ultra-small) -->
                    <form action="" method="GET" class="hidden sm:flex items-center bg-gray-800/50 rounded-lg px-3 sm:px-4 py-2 border border-transparent focus-within:border-green-primary transition-all">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5 text-gray-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        <input type="text" name="q" placeholder="Search..." value="{{ request('q') }}"
                            class="bg-transparent text-sm text-gray-100 placeholder-gray-400 outline-none w-24 md:w-48 transition-all focus:w-32 md:focus:w-64">
                    </form>

                    <!-- Profile -->
                    <div class="relative flex-shrink-0">
                        <button
                            class="flex items-center gap-2 sm:gap-3 bg-gray-800/50 rounded-lg p-1.5 sm:px-4 sm:py-2 hover:bg-gray-700/50 transition-colors border border-gray-700/50"
                            onclick="toggleProfileMenu()">
                            <div class="w-7 h-7 sm:w-8 sm:h-8 bg-green-primary rounded-full flex items-center justify-center shadow-lg shadow-green-500/20">
                                <span class="text-white font-bold text-xs sm:text-sm">{{ substr(ucfirst(auth()?->user()->name), 0, 1) }}</span>
                            </div>
                            <div class="text-left hidden xs:block">
                                <div class="text-[11px] sm:text-sm font-bold text-gray-100 leading-tight">{{ explode(' ', ucfirst(auth()?->user()->name))[0] }}</div>
                                <div class="text-[9px] sm:text-xs text-gray-500 font-medium">{{ auth()?->user()->role === 'admin' ? 'Admin' : auth()->user()->nis }}</div>
                            </div>
                            <svg class="w-3.5 h-3.5 text-gray-500 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </button>

                        <!-- Profile Dropdown -->
                        <div class="absolute right-0 mt-2 w-48 bg-gray-800 rounded-lg shadow-lg border border-gray-700 hidden"
                            id="profileMenu">
                            <a href="#"
                                class="block px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white rounded-t-lg">Profile</a>
                            <form action="{{ route('logout') }}" method="POST" class="block">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left px-4 py-2 text-sm text-gray-300 hover:bg-gray-700 hover:text-white rounded-b-lg">Logout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main class="p-4 sm:p-8 space-y-4 sm:space-y-6">
            @yield('content')
        </main>
    </div>

    <!-- Premium Delete Confirmation Modal -->
    <div id="deleteModal" class="fixed inset-0 z-[200] hidden overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen p-4 text-center">
            <!-- Modal Background Overlay -->
            <div class="fixed inset-0 bg-black/80 transition-opacity backdrop-blur-sm" onclick="closeDeleteModal()"></div>

            <!-- Modal Content -->
            <div class="relative align-middle bg-dark-surface rounded-2xl text-left overflow-hidden shadow-2xl transform transition-all max-w-md w-full border border-gray-800 scale-95 opacity-0 duration-300" id="modalContainer">
                <div class="px-6 pt-6 pb-4">
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0 w-12 h-12 rounded-xl bg-red-500/10 flex items-center justify-center text-red-500 border border-red-500/20">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-white mb-2" id="modal-title">Konfirmasi Hapus</h3>
                            <p class="text-gray-400 text-sm leading-relaxed" id="modal-message">Apakah Anda yakin ingin menghapus data ini? Tindakan ini tidak dapat dibatalkan.</p>
                        </div>
                    </div>
                </div>
                <div class="px-6 py-4 bg-gray-800/20 flex flex-row-reverse gap-3 border-t border-gray-800">
                    <button type="button" id="confirmDeleteBtn" class="px-4 py-2 bg-red-600 hover:bg-red-700 text-white text-sm font-bold rounded-lg transition-all shadow-lg shadow-red-900/20">
                        Hapus Sekarang
                    </button>
                    <button type="button" onclick="closeDeleteModal()" class="px-4 py-2 bg-gray-700 hover:bg-gray-600 text-gray-300 text-sm font-medium rounded-lg transition-all">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>

    </div>

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            
            sidebar.classList.toggle('-translate-x-full');
            overlay.classList.toggle('hidden');
            document.body.classList.toggle('overflow-hidden');
        }

        function toggleProfileMenu() {
            const menu = document.getElementById('profileMenu');
            menu.classList.toggle('hidden');
        }

        // Close profile menu when clicking outside
        document.addEventListener('click', function(event) {
            const profileMenu = document.getElementById('profileMenu');
            const profileButton = event.target.closest('button[onclick="toggleProfileMenu()"]');

            if (profileMenu && !profileButton && !profileMenu.contains(event.target)) {
                profileMenu.classList.add('hidden');
            }
        });

        // Close sidebar on window resize if it gets back to desktop
        window.addEventListener('resize', function() {
            const sidebar = document.getElementById('sidebar');
            const overlay = document.getElementById('sidebarOverlay');
            
            if (window.innerWidth >= 1024) {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            } else {
                sidebar.classList.add('-translate-x-full');
            }
        });

        // Global Delete Confirmation Modal Logic
        let formToSubmit = null;

        function confirmAction(e, message = null) {
            e.preventDefault();
            formToSubmit = e.target;
            
            const modal = document.getElementById('deleteModal');
            const container = document.getElementById('modalContainer');
            const messageEl = document.getElementById('modal-message');
            
            if (message) messageEl.innerText = message;
            
            modal.classList.remove('hidden');
            // Background blur / opacity handled via CSS
            setTimeout(() => {
                container.classList.remove('scale-95', 'opacity-0');
                container.classList.add('scale-100', 'opacity-100');
            }, 10);
            
            document.body.classList.add('overflow-hidden');
        }

        function closeDeleteModal() {
            const modal = document.getElementById('deleteModal');
            const container = document.getElementById('modalContainer');
            
            container.classList.remove('scale-100', 'opacity-100');
            container.classList.add('scale-95', 'opacity-0');
            
            setTimeout(() => {
                modal.classList.add('hidden');
                document.body.classList.remove('overflow-hidden');
            }, 300);
            
            formToSubmit = null;
        }

        document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
            if (formToSubmit) {
                formToSubmit.submit();
            }
        });
    </script>
</body>

</html>

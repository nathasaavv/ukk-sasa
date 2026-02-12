<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel')</title>
    <style>
        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
            font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        :root{
            --bg: #f4f7fb;
            --surface: #ffffff;
            --muted: #64748b;
            --text: #1e293b;
            --sidebar-bg: linear-gradient(180deg,#1e293b,#0f172a);
            --card-border: #f1f5f9;
            --primary: #2563eb;
            --primary-600: #1d4ed8;
            --success-from: #16a34a;
            --success-to: #10b981;
            --toast-text: #ffffff;
        }
        body{
            background:var(--bg);
            color:var(--text);
            transition:background .2s ease,color .2s ease;
        }

        /* Dark mode overrides (toggle .dark on <html> or <body>) */
        .dark{
            --bg: #0b1220;
            --surface: #0f1724;
            --muted: #9ca3af;
            --text: #e6eef8;
            --sidebar-bg: linear-gradient(180deg,#071029,#041227);
            --card-border: rgba(255,255,255,0.04);
        }

        .layout{
            display:flex;
            min-height:100vh;
        }

        /* Sidebar */
        .sidebar{
            width:260px;
            background:var(--sidebar-bg);
            color:white;
            padding:20px;
            position:fixed;
            height:100vh;
            overflow-y:auto;
            z-index:1000;
            transition: width 220ms ease, background .2s ease;
        }

        .logo{
            font-size:20px;
            font-weight:700;
            margin-bottom:40px;
            display:flex;
            align-items:center;
            gap:10px;
        }

        .logo::before{
            content: "🎯";
            font-size:24px;
        }

        .menu a{
            display:flex;
            align-items:center;
            gap:12px;
            padding:12px 15px;
            margin-bottom:10px;
            color:#cbd5e1;
            text-decoration:none;
            border-radius:10px;
            transition:background .18s ease,transform .18s ease;
            position:relative;
            justify-content:flex-start;
        }
        .menu a span:last-child{display:inline-block}
        .menu a span:first-child{font-size:18px}
        .menu a[title]{cursor:default} /* keep title tooltips */



        .menu a::before{
            content: "";
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 4px;
            height: 0;
            background: #2563eb;
            border-radius: 0 2px 2px 0;
            transition: height 0.3s ease;
        }

        .menu a:hover, .menu a.active{
            background:#2563eb;
            color:white;
        }

        .menu a.active::before{
            height: 20px;
        }

        .menu a span{
            font-size:16px;
        }

        .menu form {
            margin: 0;
            padding: 0;
            width: 100%;
        }

        .menu form button {
            width: 100%;
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 15px;
            margin-bottom: 10px;
            color: #cbd5e1;
            background: none;
            border: none;
            border-radius: 10px;
            transition: .3s;
            position: relative;
            cursor: pointer;
            font-family: inherit;
            font-size: inherit;
        }

        .menu form button::before {
            content: "";
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            width: 4px;
            height: 0;
            background: #2563eb;
            border-radius: 0 2px 2px 0;
            transition: height 0.3s ease;
        }

        .menu form button:hover, .menu form button.active {
            background: #2563eb;
            color: white;
        }

        .menu form button.active::before {
            height: 20px;
        }

        .menu form button span {
            font-size: 16px;
        }

        /* Main */
        .main{
            margin-left:260px; /* match default sidebar */
            width:calc(100% - 260px);
            transition: margin-left 220ms ease, width 220ms ease;
        }

        .header{
            background:var(--surface);
            padding:22px 36px; /* slightly more breathing room */
            display:flex;
            justify-content:space-between;
            align-items:center;
            box-shadow:0 6px 28px rgba(2,6,23,.06);
            position:sticky;
            top:0;
            z-index:100;
        }

        .header h1{
            font-size:24px;
            color:var(--text);
            font-weight:700;
        }

        .header-actions{
            display:flex;
            align-items:center;
            gap:15px;
            position:relative; /* for profile dropdown */
        }

        .profile{
            display:flex;
            align-items:center;
            gap:12px;
            padding:10px 14px;
            background:var(--surface);
            border-radius:12px;
            cursor:pointer;
            transition: all 0.18s ease;
            border:1px solid transparent;
        }

        .profile:hover{
            transform:translateY(-2px);
            box-shadow:0 8px 22px rgba(2,6,23,.06);
        }

        .avatar{
            width:40px;
            height:40px;
            border-radius:50%;
            background:linear-gradient(135deg,#2563eb,#1d4ed8);
            display:flex;
            align-items:center;
            justify-content:center;
            color:white;
            font-weight:600;
        }

        .profile-info{
            display:flex;
            flex-direction:column;
        }

        .profile-name{
            font-size:14px;
            font-weight:600;
            color:var(--text);
        }

        .profile-role{
            font-size:12px;
            color:var(--muted);
        }

        /* utility text colors */
        .text-muted{ color: var(--muted); }
        .text-body{ color: var(--text); }

        /* Profile dropdown */
        .profile-menu{
            position:absolute;
            right:8px;
            top:calc(100% + 10px);
            min-width:180px;
            background:var(--surface);
            border-radius:10px;
            box-shadow:0 12px 36px rgba(2,6,23,.12);
            padding:8px;
            display:none;
            flex-direction:column;
            gap:6px;
            z-index:1500;
            border:1px solid var(--card-border);
        }

        .profile-menu.show{display:flex}
        .profile-menu-item{background:transparent;border:none;padding:8px 10px;text-align:left;border-radius:8px;cursor:pointer;color:var(--text);text-decoration:none}
        .profile-menu-item:hover{background:rgba(2,6,23,.04)}

        /* Theme toggle */
        #themeToggle{padding:8px 10px;border-radius:8px;border:1px solid var(--card-border);background:var(--surface);color:var(--text);cursor:pointer}
        #themeToggle[aria-pressed="true"]{background:linear-gradient(90deg,var(--primary),var(--primary-600));color:#fff}
        .dark #themeToggle{background:transparent;border-color:rgba(255,255,255,0.06);color:var(--text)}

        /* Dark mode surface adjustments */
        .dark .profile-menu{background:rgba(255,255,255,0.02);border-color:var(--card-border)}
        .dark #themeToggle{background:transparent}


        .content{
            padding:36px; /* more generous spacing */
        }

        /* Buttons */
        .btn{
            padding:10px 16px;
            border-radius:10px;
            text-decoration:none;
            font-weight:600;
            font-size:14px;
            transition:.3s;
            display:inline-flex;
            align-items:center;
            gap:6px;
            cursor:pointer;
            border:none;
        }

        .btn-primary{
            background:#2563eb;
            color:white;
        }

        .btn-primary:hover{
            background:#1d4ed8;
            transform:translateY(-2px);
            box-shadow:0 4px 15px rgba(37, 99, 235, 0.3);
        }

        .btn-secondary{
            background:#64748b;
            color:white;
        }

        .btn-secondary:hover{
            background:#475569;
            transform:translateY(-2px);
        }

        .btn-success{
            background:#16a34a;
            color:white;
        }

        .btn-success:hover{
            background:#15803d;
            transform:translateY(-2px);
        }

        .btn-warning{
            background:#f59e0b;
            color:white;
        }

        .btn-warning:hover{
            background:#d97706;
            transform:translateY(-2px);
        }

        .btn-danger{
            background:#ef4444;
            color:white;
        }

        .btn-danger:hover{
            background:#dc2626;
            transform:translateY(-2px);
        }

        .btn-sm{
            padding:6px 12px;
            font-size:12px;
        }

        /* Cards */
        .cards{
            display:grid;
            grid-template-columns:repeat(auto-fit,minmax(260px,1fr));
            gap:28px; /* increased gap for airy layout */
            margin-bottom:36px;
        }

        .card{
            background:var(--surface);
            padding:24px; /* a bit more padding */
            border-radius:16px;
            box-shadow:0 8px 30px rgba(2,6,23,.06);
            transition: all 0.28s ease;
            border:1px solid var(--card-border);
            min-height:92px;
        }

        .card:hover{
            transform: translateY(-5px);
            box-shadow:0 20px 40px rgba(2,6,23,.09);
        }

        .card-header{
            display:flex;
            align-items:center;
            justify-content:space-between;
            margin-bottom:15px;
        }

        .card-icon{
            width:48px;
            height:48px;
            border-radius:12px;
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:20px;
        }

        .card-icon.blue{
            background:#dbeafe;
            color:#2563eb;
        }

        .card-icon.green{
            background:#dcfce7;
            color:#16a34a;
        }

        .card-icon.yellow{
            background:#fef3c7;
            color:#d97706;
        }

        .card-icon.purple{
            background:#f3e8ff;
            color:#9333ea;
        }

        .card h3{
            font-size:14px;
            color:var(--muted);
            font-weight:500;
            margin-bottom:8px;
        }

        .card-value{
            font-size:28px;
            font-weight:700;
            color:var(--text);
            margin-bottom:8px;
        }

        /* Dark-mode tweaks for icons (better contrast on dark bg) */
        .dark .card-icon.blue{background:rgba(37,99,235,0.08)}
        .dark .card-icon.green{background:rgba(16,163,127,0.06)}
        .dark .card-icon.yellow{background:rgba(217,119,6,0.05)}
        .dark .card-icon.purple{background:rgba(147,51,234,0.05)}

        .card-change{
            font-size:12px;
            font-weight:500;
            display:flex;
            align-items:center;
            gap:4px;
        }

        .card-change.positive{
            color:#16a34a;
        }

        .card-change.negative{
            color:#dc2626;
        }

        /* Table */
        .table-container{
            background:var(--surface);
            border-radius:16px;
            box-shadow:0 10px 25px rgba(2,6,23,.05);
            overflow:hidden;
            border:1px solid var(--card-border);
        }
        .dark .table-container{background:rgba(255,255,255,0.01);border-color:rgba(255,255,255,0.03)}

        .table-header{
            padding:20px 25px;
            border-bottom:1px solid #e5e7eb;
            display:flex;
            justify-content:space-between;
            align-items:center;
            flex-wrap:wrap;
            gap:15px;
        }

        .table-title{
            font-size:18px;
            font-weight:600;
            color:var(--text);
        }

        .table-actions{
            display:flex;
            gap:10px;
            align-items:center;
        }

        .search-box{
            position:relative;
        }

        .search-box input{
            padding:8px 12px 8px 36px;
            border:1px solid #e5e7eb;
            border-radius:8px;
            font-size:14px;
            width:250px;
            transition: all 0.3s ease;
        }

        .search-box input:focus{
            outline:none;
            border-color:#2563eb;
            box-shadow:0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        .search-box::before{
            content: "🔍";
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            font-size:14px;
        }

        .table-wrapper{
            overflow-x:auto;
        }

        table{
            width:100%;
            border-collapse:collapse;
        }

        table th{
            background:var(--surface);
            font-weight:600;
            color:var(--muted);
            text-align:left;
            padding:12px 16px;
            font-size:14px;
            border-bottom:1px solid var(--card-border);
        }

        table td{
            padding:12px 16px;
            border-bottom:1px solid var(--card-border);
            font-size:14px;
            color:var(--muted);
            background:transparent;
        }

        table tbody tr:hover{
            background:rgba(2,6,23,.03);
        }

        .badge{
            padding:4px 10px;
            border-radius:20px;
            font-size:12px;
            font-weight:600;
            display:inline-block;
        }

        .badge.pending{background:#fef3c7;color:#92400e;}
        .badge.done{background:#dcfce7;color:#166534;}
        .badge.processing{background:#dbeafe;color:#1e40af;}
        .badge.cancelled{background:#fecaca;color:#991b1b;}

        /* Dark-mode table / badges */
        .dark table th{background:transparent;color:var(--muted);border-color:rgba(255,255,255,0.04)}
        .dark table td{color:var(--muted);border-color:rgba(255,255,255,0.04)}
        .dark table tbody tr:hover{background:rgba(255,255,255,0.02)}
        .dark .badge{opacity:.95}
        .dark .badge.pending{background:rgba(255,248,220,0.06);color:#f59e0b}
        .dark .badge.done{background:rgba(16,185,129,0.06);color:#34d399}
        .dark .badge.processing{background:rgba(59,130,246,0.06);color:#60a5fa}
        .dark .badge.cancelled{background:rgba(254,202,202,0.04);color:#fb7185}

        /* Form */
        .form-container{
            background:var(--surface);
            border-radius:16px;
            box-shadow:0 8px 24px rgba(2,6,23,.06);
            padding:25px;
            border:1px solid var(--card-border);
        }

        .form-group{
            margin-bottom:20px;
        }

        .form-group label{
            display:block;
            margin-bottom:8px;
            color:var(--muted);
            font-weight:500;
            font-size:14px;
        }

        .form-control{
            width:100%;
            padding:10px 14px;
            border:1px solid var(--card-border);
            border-radius:8px;
            font-size:14px;
            transition: all 0.3s ease;
            background:transparent;
            color:var(--text);
        }

        .form-control:focus{
            outline:none;
            border-color:var(--primary);
            box-shadow:0 0 0 3px rgba(37, 99, 235, 0.08);
        }

        textarea.form-control{
            resize:vertical;
            min-height:100px;
        }

        .dark .form-control{background:rgba(255,255,255,0.02);color:var(--text);border-color:rgba(255,255,255,0.04)}

        /* Alert */
        .alert{
            padding:12px 16px;
            border-radius:8px;
            margin-bottom:20px;
            display:flex;
            align-items:center;
            gap:10px;
        }

        .alert-success{
            background:#f0fdf4;
            border:1px solid #bbf7d0;
            color:#16a34a;
        }

        .alert-error{
            background:#fef2f2;
            border:1px solid #fecaca;
            color:#dc2626;
        }

        .alert-warning{
            background:#fffbeb;
            border:1px solid #fed7aa;
            color:#d97706;
        }

        /* Toast (global) */
        .toast{
            position:fixed;
            right:24px;
            top:24px;
            min-width:260px;
            max-width:360px;
            background:linear-gradient(90deg,#16a34a,#10b981);
            color:#fff;
            padding:12px 14px;
            border-radius:10px;
            box-shadow:0 12px 36px rgba(2,6,23,.28);
            display:flex;
            align-items:center;
            gap:12px;
            transform:translateY(-8px);
            opacity:0;
            transition:transform .28s cubic-bezier(.2,.9,.2,1),opacity .28s ease;
            z-index:2000;
        }
        .toast.show{transform:none;opacity:1}
        .toast .toast-body{flex:1;font-weight:600}
        .toast.success{background:linear-gradient(90deg,#16a34a,#10b981);color:#fff}
        .toast .close-btn{background:transparent;border:none;color:rgba(255,255,255,.95);font-size:18px;cursor:pointer;padding:4px}

        /* Empty State */
        .empty-state{
            text-align:center;
            padding:60px 20px;
            color:var(--muted);
        }

        .empty-icon{
            font-size:64px;
            margin-bottom:20px;
            opacity:0.5;
        }

        .empty-title{
            font-size:20px;
            color:var(--text);
            margin-bottom:8px;
            font-weight:600;
        }

        .empty-description{
            font-size:14px;
            margin-bottom:20px;
        }

        /* Mobile Menu Toggle */
        .mobile-menu-toggle{
            display:none;
            background:none;
            border:none;
            font-size:24px;
            cursor:pointer;
            color:var(--text);
        }

        /* Responsive */
        @media(max-width:900px){
            .sidebar{width:200px}
            .main{margin-left:200px;width:calc(100% - 200px)}
        }

        @media(max-width:768px){
            .mobile-menu-toggle{
                display:block;
            }

            .sidebar{
                transform: translateX(-100%);
                width:260px;
            }

            .sidebar.active{
                transform: translateX(0);
            }

            .main{
                margin-left:0;
                width:100%;
            }

            .header{
                padding:15px 20px;
            }

            .header h1{
                font-size:20px;
            }

            .content{
                padding:20px;
            }

            .cards{
                grid-template-columns:1fr;
            }

            .table-header{
                flex-direction:column;
                align-items:flex-start;
            }

            .search-box input{
                width:100%;
            }

            .table-actions{
                width:100%;
                justify-content:space-between;
            }
        }

        /* Logout confirmation modal */
        .modal-overlay{
            position:fixed;
            inset:0;
            background:rgba(2,6,23,0.6);
            display:none;
            align-items:center;
            justify-content:center;
            z-index:2000;
        }
        .modal-overlay.show{display:flex}
        .modal-content{
            background:var(--surface);
            width:min(420px, calc(100% - 40px));
            border-radius:12px;
            box-shadow:0 20px 50px rgba(2,6,23,0.3);
            padding:20px;
            text-align:left;
            border:1px solid var(--card-border);
        }
        .modal-header{display:flex;justify-content:space-between;align-items:center;margin-bottom:8px}
        .modal-title{font-weight:700;color:var(--text)}
        .modal-body{color:var(--muted);margin-bottom:16px}
        .modal-footer{display:flex;justify-content:flex-end;gap:10px}
        .dark .modal-content{background:rgba(255,255,255,0.02);border-color:rgba(255,255,255,0.03)}

    </style>
</head>
<body>
    <div class="layout">
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="logo">Admin Panel</div>
            <nav class="menu">
                <a href="{{ route('dashboard.index') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <span>📊</span>
                    <span>Dashboard</span>
                </a>
                <a href="#" class="{{ request()->routeIs('aspirasi.*') ? 'active' : '' }}">
                    <span>💬</span>
                    <span>Aspirasi</span>
                </a>
                <a href="{{ route('siswa.index') }}" class="{{ request()->routeIs('siswa.*') ? 'active' : '' }}">
                    <span>👥</span>
                    <span>Siswa</span>
                </a>
                <a href="{{ route('kategori.index') }}" class="{{ request()->routeIs('kategori.*') ? 'active' : '' }}">
                    <span>📁</span>
                    <span>Kategori</span>
                </a>
                <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <span>⚙️</span>
                    <span>Admin</span>
                </a>
            </nav>
        </aside>

        <!-- Main -->
        <div class="main">
            <!-- Header -->
            <header class="header">
                <div style="display:flex;align-items:center;gap:15px;">
                    <button class="mobile-menu-toggle" onclick="toggleSidebar()">☰</button>
                    @yield('header')
                </div>
                <div class="header-actions">
                    @yield('header-actions')

                    <button id="themeToggle" class="btn btn-secondary" aria-pressed="false" title="Toggle dark mode">🌙</button>

                    <div class="profile" id="profileBtn" tabindex="0" aria-haspopup="true" aria-expanded="false" role="button">
                        <div class="avatar">A</div>
                        <div class="profile-info">
                            <span class="profile-name">Admin</span>
                            <span class="profile-role">Administrator</span>
                        </div>
                    </div>

                    <div class="profile-menu" id="profileMenu" role="menu" aria-hidden="true">
                        <a href="#" class="profile-menu-item">Profil</a>
                        <button type="button" class="profile-menu-item" id="logoutBtn">Logout</button>
                        <form id="logoutForm" action="{{ route('logout') }}" method="POST" style="display:none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <main class="content">
                @yield('content')
            </main>
        </div>
    </div>

    @if(session('success'))
        <div id="globalToast" class="toast success" role="status" aria-live="polite">
            <div class="toast-body">{{ session('success') }}</div>
            <button id="toastClose" class="close-btn" aria-label="Tutup">×</button>
        </div>
    @endif

    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('active');
        }

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const toggle = document.querySelector('.mobile-menu-toggle');

            if (window.innerWidth <= 768 &&
                !sidebar.contains(event.target) &&
                !toggle.contains(event.target) &&
                sidebar.classList.contains('active')) {
                sidebar.classList.remove('active');
            }
        });

        /* Theme (dark mode) ------------------------------------------------- */
        (function(){
            const themeToggle = document.getElementById('themeToggle');
            const root = document.documentElement;
            const stored = localStorage.getItem('theme');

            function applyTheme(isDark){
                if(isDark){
                    root.classList.add('dark');
                    themeToggle && themeToggle.setAttribute('aria-pressed','true');
                    themeToggle && (themeToggle.textContent = '☀️');
                } else {
                    root.classList.remove('dark');
                    themeToggle && themeToggle.setAttribute('aria-pressed','false');
                    themeToggle && (themeToggle.textContent = '🌙');
                }
            }

            // initialise from storage / prefers-color-scheme
            if(stored === 'dark') applyTheme(true);
            else if(stored === 'light') applyTheme(false);
            else applyTheme(window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches);

            themeToggle && themeToggle.addEventListener('click', function(){
                const isDark = document.documentElement.classList.toggle('dark');
                localStorage.setItem('theme', isDark ? 'dark' : 'light');
                applyTheme(isDark);
            });
        })();

        /* Profile dropdown -------------------------------------------------- */
        (function(){
            const profileBtn = document.getElementById('profileBtn');
            const profileMenu = document.getElementById('profileMenu');

            function closeMenu(){
                profileMenu && profileMenu.classList.remove('show');
                profileBtn && profileBtn.setAttribute('aria-expanded','false');
                profileMenu && profileMenu.setAttribute('aria-hidden','true');
            }
            function openMenu(){
                profileMenu && profileMenu.classList.add('show');
                profileBtn && profileBtn.setAttribute('aria-expanded','true');
                profileMenu && profileMenu.setAttribute('aria-hidden','false');
            }

            profileBtn && profileBtn.addEventListener('click', function(e){
                e.stopPropagation();
                profileMenu.classList.contains('show') ? closeMenu() : openMenu();
            });

            document.addEventListener('click', function(e){
                if(profileMenu && !profileMenu.contains(e.target) && profileBtn && !profileBtn.contains(e.target)){
                    closeMenu();
                }
            });

            document.addEventListener('keydown', function(e){ if(e.key === 'Escape') closeMenu(); });
        })();

        // Auto-hide alerts after 5 seconds
        setTimeout(() => {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                alert.style.display = 'none';
            });
        }, 5000);

        /* Logout confirmation modal behaviour */
        // create modal HTML and append to body
        (function(){
            const modalHtml = `
                <div class="modal-overlay" id="logoutModal" aria-hidden="true">
                    <div class="modal-content" role="dialog" aria-modal="true" aria-labelledby="logoutModalTitle">
                        <div class="modal-header">
                            <div class="modal-title" id="logoutModalTitle">Konfirmasi Logout</div>
                            <button id="logoutModalClose" aria-label="Tutup" style="background:none;border:none;font-size:18px;cursor:pointer">×</button>
                        </div>
                        <div class="modal-body">Apakah anda yakin ingin logout?</div>
                        <div class="modal-footer">
                            <button class="btn btn-secondary" id="logoutCancel">Batal</button>
                            <button class="btn btn-danger" id="logoutConfirm">Ya, Logout</button>
                        </div>
                    </div>
                </div>
            `;
            document.body.insertAdjacentHTML('beforeend', modalHtml);

            const logoutBtn = document.getElementById('logoutBtn');
            const logoutModal = document.getElementById('logoutModal');
            const logoutCancel = document.getElementById('logoutCancel');
            const logoutClose = document.getElementById('logoutModalClose');
            const logoutConfirm = document.getElementById('logoutConfirm');
            const logoutForm = document.getElementById('logoutForm');

            function openModal(){
                logoutModal.classList.add('show');
                logoutModal.setAttribute('aria-hidden', 'false');
            }
            function closeModal(){
                logoutModal.classList.remove('show');
                logoutModal.setAttribute('aria-hidden', 'true');
            }

            logoutBtn && logoutBtn.addEventListener('click', (e)=>{ e.preventDefault(); openModal(); });
            logoutCancel && logoutCancel.addEventListener('click', closeModal);
            logoutClose && logoutClose.addEventListener('click', closeModal);
            logoutModal && logoutModal.addEventListener('click', function(e){ if(e.target === logoutModal) closeModal(); });
            document.addEventListener('keydown', function(e){ if(e.key === 'Escape') closeModal(); });

            logoutConfirm && logoutConfirm.addEventListener('click', function(){
                // submit the actual logout form
                logoutForm && logoutForm.submit();
            });
        })();
    </script>
</body>
</html>

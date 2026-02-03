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

        body{
            background:#f4f7fb;
        }

        .layout{
            display:flex;
            min-height:100vh;
        }

        /* Sidebar */
        .sidebar{
            width:260px;
            background:linear-gradient(180deg,#1e293b,#0f172a);
            color:white;
            padding:20px;
            position:fixed;
            height:100vh;
            overflow-y:auto;
            z-index:1000;
            transition: all 0.3s ease;
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
            transition:.3s;
            position:relative;
        }

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

        /* Main */
        .main{
            margin-left:260px;
            width:calc(100% - 260px);
            transition: all 0.3s ease;
        }

        .header{
            background:white;
            padding:20px 30px;
            display:flex;
            justify-content:space-between;
            align-items:center;
            box-shadow:0 4px 20px rgba(0,0,0,.05);
            position:sticky;
            top:0;
            z-index:100;
        }

        .header h1{
            font-size:24px;
            color:#1e293b;
            font-weight:700;
        }

        .header-actions{
            display:flex;
            align-items:center;
            gap:15px;
        }

        .profile{
            display:flex;
            align-items:center;
            gap:12px;
            padding:8px 12px;
            background:#f8fafc;
            border-radius:10px;
            cursor:pointer;
            transition: all 0.3s ease;
        }

        .profile:hover{
            background:#e2e8f0;
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
            color:#1e293b;
        }

        .profile-role{
            font-size:12px;
            color:#64748b;
        }

        .content{
            padding:30px;
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
            grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
            gap:20px;
            margin-bottom:30px;
        }

        .card{
            background:white;
            padding:20px;
            border-radius:16px;
            box-shadow:0 10px 25px rgba(0,0,0,.05);
            transition: all 0.3s ease;
            border:1px solid #f1f5f9;
        }

        .card:hover{
            transform: translateY(-5px);
            box-shadow:0 20px 40px rgba(0,0,0,.1);
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
            color:#64748b;
            font-weight:500;
            margin-bottom:8px;
        }

        .card-value{
            font-size:28px;
            font-weight:700;
            color:#1e293b;
            margin-bottom:8px;
        }

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
            background:white;
            border-radius:16px;
            box-shadow:0 10px 25px rgba(0,0,0,.05);
            overflow:hidden;
            border:1px solid #f1f5f9;
        }

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
            color:#1e293b;
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
            background:#f8fafc;
            font-weight:600;
            color:#374151;
            text-align:left;
            padding:12px 16px;
            font-size:14px;
            border-bottom:1px solid #e5e7eb;
        }

        table td{
            padding:12px 16px;
            border-bottom:1px solid #f1f5f9;
            font-size:14px;
            color:#374151;
        }

        table tbody tr:hover{
            background:#f8fafc;
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

        /* Form */
        .form-container{
            background:white;
            border-radius:16px;
            box-shadow:0 10px 25px rgba(0,0,0,.05);
            padding:25px;
            border:1px solid #f1f5f9;
        }

        .form-group{
            margin-bottom:20px;
        }

        .form-group label{
            display:block;
            margin-bottom:8px;
            color:#374151;
            font-weight:500;
            font-size:14px;
        }

        .form-control{
            width:100%;
            padding:10px 14px;
            border:1px solid #e5e7eb;
            border-radius:8px;
            font-size:14px;
            transition: all 0.3s ease;
        }

        .form-control:focus{
            outline:none;
            border-color:#2563eb;
            box-shadow:0 0 0 3px rgba(37, 99, 235, 0.1);
        }

        textarea.form-control{
            resize:vertical;
            min-height:100px;
        }

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

        /* Empty State */
        .empty-state{
            text-align:center;
            padding:60px 20px;
            color:#64748b;
        }

        .empty-icon{
            font-size:64px;
            margin-bottom:20px;
            opacity:0.5;
        }

        .empty-title{
            font-size:20px;
            color:#374151;
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
            color:#374151;
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
    </style>
</head>
<body>
    <div class="layout">
        <!-- Sidebar -->
        <aside class="sidebar" id="sidebar">
            <div class="logo">Admin Panel</div>
            <nav class="menu">
                <a href="#" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    <span>📊</span>
                    <span>Dashboard</span>
                </a>
                <a href="#" class="{{ request()->routeIs('aspirasi.*') ? 'active' : '' }}">
                    <span>💬</span>
                    <span>Aspirasi</span>
                </a>
                <a href="#" class="{{ request()->routeIs('siswa.*') ? 'active' : '' }}">
                    <span>👥</span>
                    <span>Siswa</span>
                </a>
                <a href="{{ route('kategori.index') }}" class="{{ request()->routeIs('kategori.*') ? 'active' : '' }}">
                    <span>📁</span>
                    <span>Kategori</span>
                </a>
                <a href="#" class="{{ request()->routeIs('admin.*') ? 'active' : '' }}">
                    <span>⚙️</span>
                    <span>Admin</span>
                </a>
                <a href="#" class="{{ request()->routeIs('logout') ? 'active' : '' }}">
                    <span>🚪</span>
                    <span>Logout</span>
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
                    <div class="profile">
                        <div class="avatar">A</div>
                        <div class="profile-info">
                            <span class="profile-name">Admin</span>
                            <span class="profile-role">Administrator</span>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content -->
            <main class="content">
                @yield('content')
            </main>
        </div>
    </div>

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

        // Auto-hide alerts after 5 seconds
        setTimeout(() => {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                alert.style.display = 'none';
            });
        }, 5000);
    </script>
</body>
</html>

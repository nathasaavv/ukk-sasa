<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Kategori</title>
</head>
<body>
<div class="layout">
    <!-- Sidebar -->
    <aside class="sidebar">
        <div class="logo">Admin Panel</div>
        <nav class="menu">
            <a href="#">Dashboard</a>
            <a href="#">Aspirasi</a>
            <a href="#">Siswa</a>
            <a href="#" class="active">Kategori</a>
            <a href="#">Admin</a>
            <a href="#">Logout</a>
        </nav>
    </aside>

    <!-- Main -->
    <div class="main">
        <header class="header">
            <div style="display:flex;align-items:center;gap:15px;">
                <a href="{{ route('kategori.index') }}" 
                   style="padding:8px 12px;background:#64748b;color:white;text-decoration:none;border-radius:6px;font-size:14px;">
                    ← Kembali
                </a>
                <h1>Detail Kategori</h1>
            </div>
            <div class="profile">
                <div class="avatar"></div>
                <span>Admin</span>
            </div>
        </header>

        <section class="content">
            @forelse ($show as $item)
            <div class="detail-container">
                <!-- Detail Card -->
                <div class="detail-card">
                    <div class="detail-header">
                        <h2>{{ $item->nama  ?? 'Nama Kategori' }}</h2>
                        <div class="detail-actions">
                            <a href="#" 
                               style="padding:8px 16px;background:#f59e0b;color:white;text-decoration:none;border-radius:8px;font-size:14px;">
                                Edit
                            </a>
                        </div>
                    </div>

                    <div class="detail-content">
                        <div class="detail-section">
                            <h3>Informasi Kategori</h3>
                            <div class="info-grid">
                                <div class="info-item">
                                    <label>Nama Kategori</label>
                                    <p>{{ $item->nama ?? 'Nama Kategori' }}</p>
                                </div>
                                <div class="info-item">
                                    <label>Keterangan</label>
                                    <p>{{ $item->ket_kategori ?? 'Tidak ada keterangan' }}</p>
                                </div>
                                <div class="info-item">
                                    <label>Jumlah Aspirasi</label>
                                    <p>
                                        <span class="badge {{ $item->aspirasi_count ?? 0 > 0 ? 'done' : 'pending' }}">
                                            {{ $item->aspirasi_count ?? 0 }} aspirasi
                                        </span>
                                    </p>
                                </div>
                                <div class="info-item">
                                    <label>Status</label>
                                    <p>
                                        <span class="badge {{ $item->aspirasi_count ?? 0 > 0 ? 'done' : 'pending' }}">
                                            {{ $item->aspirasi_count ?? 0 > 0 ? 'Aktif' : 'Tidak Aktif' }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Statistics -->
                        <div class="stats-section">
                            <h3>Statistik</h3>
                            <div class="stats-grid">
                                <div class="stat-card">
                                    <div class="stat-icon">📊</div>
                                    <div class="stat-info">
                                        <h4>{{ $item->aspirasi_count ?? 0 }}</h4>
                                        <p>Total Aspirasi</p>
                                    </div>
                                </div>
                                <div class="stat-card">
                                    <div class="stat-icon">📈</div>
                                    <div class="stat-info">
                                        <h4>{{ $loop->iteration }}</h4>
                                        <p>Urutan Kategori</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Aspirations (Placeholder) -->
                <div class="recent-card">
                    <h3>Aspirasi Terkait</h3>
                    <div class="empty-state">
                        <div class="empty-icon">📝</div>
                        <p>Belum ada aspirasi untuk kategori ini</p>
                        <small>Tambahkan aspirasi baru untuk melihat di sini</small>
                    </div>
                </div>
            </div>
            @empty
            <div class="empty-state">
                <div class="empty-icon">📂</div>
                <h3>Kategori tidak ditemukan</h3>
                <p>Kategori yang Anda cari tidak tersedia</p>
                <a href="{{ route('kategori.index') }}" 
                   style="padding:10px 20px;background:#2563eb;color:white;text-decoration:none;border-radius:8px;display:inline-block;margin-top:15px;">
                    Kembali ke Daftar Kategori
                </a>
            </div>
            @endforelse
        </section>
    </div>
</div>

<style>
*{
    margin:0;
    padding:0;
    box-sizing:border-box;
    font-family:'Segoe UI', sans-serif;
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
}

.logo{
    font-size:20px;
    font-weight:700;
    margin-bottom:40px;
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
}

.menu a:hover, .menu a.active{
    background:#2563eb;
    color:white;
}

/* Main */
.main{
    margin-left:260px;
    width:calc(100% - 260px);
}

.header{
    background:white;
    padding:20px 30px;
    display:flex;
    justify-content:space-between;
    align-items:center;
    box-shadow:0 4px 20px rgba(0,0,0,.05);
}

.header h1{
    font-size:22px;
}

.profile{
    display:flex;
    align-items:center;
    gap:12px;
}

.avatar{
    width:40px;
    height:40px;
    border-radius:50%;
    background:#2563eb;
}

.content{
    padding:30px;
}

/* Detail Container */
.detail-container{
    display:grid;
    gap:25px;
}

.detail-card{
    background:white;
    border-radius:16px;
    box-shadow:0 10px 25px rgba(0,0,0,.05);
    overflow:hidden;
}

.detail-header{
    padding:25px 30px;
    border-bottom:1px solid #e5e7eb;
    display:flex;
    justify-content:space-between;
    align-items:center;
}

.detail-header h2{
    font-size:24px;
    color:#1e293b;
    font-weight:700;
}

.detail-content{
    padding:30px;
}

.detail-section{
    margin-bottom:30px;
}

.detail-section h3{
    font-size:18px;
    color:#374151;
    margin-bottom:20px;
    font-weight:600;
}

.info-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(250px,1fr));
    gap:20px;
}

.info-item{
    padding:20px;
    background:#f8fafc;
    border-radius:12px;
    border:1px solid #e2e8f0;
}

.info-item label{
    display:block;
    font-size:12px;
    color:#64748b;
    font-weight:600;
    text-transform:uppercase;
    margin-bottom:8px;
}

.info-item p{
    font-size:16px;
    color:#1e293b;
    font-weight:500;
}

/* Stats Section */
.stats-section{
    padding-top:20px;
    border-top:1px solid #e5e7eb;
}

.stats-grid{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(200px,1fr));
    gap:20px;
}

.stat-card{
    display:flex;
    align-items:center;
    gap:15px;
    padding:20px;
    background:#f8fafc;
    border-radius:12px;
    border:1px solid #e2e8f0;
}

.stat-icon{
    font-size:32px;
    width:60px;
    height:60px;
    display:flex;
    align-items:center;
    justify-content:center;
    background:#2563eb;
    border-radius:12px;
}

.stat-info h4{
    font-size:24px;
    color:#1e293b;
    font-weight:700;
    margin-bottom:4px;
}

.stat-info p{
    font-size:14px;
    color:#64748b;
}

/* Recent Card */
.recent-card{
    background:white;
    border-radius:16px;
    box-shadow:0 10px 25px rgba(0,0,0,.05);
    padding:25px 30px;
}

.recent-card h3{
    font-size:18px;
    color:#374151;
    margin-bottom:20px;
    font-weight:600;
}

/* Empty State */
.empty-state{
    text-align:center;
    padding:40px 20px;
    color:#64748b;
}

.empty-icon{
    font-size:48px;
    margin-bottom:15px;
    opacity:0.5;
}

.empty-state h3{
    font-size:18px;
    color:#374151;
    margin-bottom:8px;
}

.empty-state p{
    font-size:14px;
    margin-bottom:5px;
}

.empty-state small{
    font-size:12px;
    color:#9ca3af;
}

/* Badge */
.badge{
    padding:6px 12px;
    border-radius:20px;
    font-size:12px;
    font-weight:600;
    display:inline-block;
}

.badge.pending{background:#fef3c7;color:#92400e;}
.badge.done{background:#dcfce7;color:#166534;}

/* Responsive */
@media(max-width:900px){
    .sidebar{width:200px}
    .main{margin-left:200px;width:calc(100% - 200px)}
}

@media(max-width:700px){
    .sidebar{display:none}
    .main{margin-left:0;width:100%}
    
    .detail-header{
        flex-direction:column;
        align-items:flex-start;
        gap:15px;
    }
    
    .info-grid{
        grid-template-columns:1fr;
    }
    
    .stats-grid{
        grid-template-columns:1fr;
    }
}
</style>
</body>
</html>
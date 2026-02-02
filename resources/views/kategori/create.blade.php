<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Kategori</title>
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
            <h1>Tambah Kategori</h1>
            <div style="display:flex;align-items:center;gap:15px;">
                <a href="{{ route('kategori.index') }}" class="btn-back">← Kembali</a>
                <div class="profile">
                    <div class="avatar"></div>
                    <span>Admin</span>
                </div>
            </div>
        </header>

        <section class="content">
            <!-- Form Box -->
            <div class="form-box">
                <h2>Form Tambah Kategori</h2>
                <p style="color:#64748b;margin-bottom:30px;">Isi data kategori baru di bawah ini</p>
                
                <form action="{{ route('kategori.store') }}" method="POST" class="kategori-form">
                    @csrf
                    <div class="form-group">
                        <label for="ket_kategori">Nama Kategori</label>
                        <input type="text" 
                               id="ket_kategori" 
                               name="nama" 
                               placeholder="Masukkan nama kategori" 
                               required>
                        <small class="form-help">Contoh: Fasilitas Sekolah, Kegiatan Ekstrakurikuler, dll</small>
                    </div>

                    <div class="form-group">
                        <label for="deskripsi">Deskripsi (Opsional)</label>
                        <textarea id="deskripsi" 
                                  name="ket_kategori" 
                                  rows="4" 
                                  placeholder="Tambahkan deskripsi untuk kategori ini..."></textarea>
                    </div>

                    <div class="form-actions">
                        <button type="button" class="btn-cancel" onclick="window.history.back()">
                            Batal
                        </button>
                        <button type="submit" class="btn-submit">
                            Simpan Kategori
                        </button>
                    </div>
                </form>
            </div>

            <!-- Info Box -->
            <div class="info-box">
                <h3>💡 Tips</h3>
                <ul>
                    <li>Buat nama kategori yang jelas dan mudah dipahami</li>
                    <li>Hindari nama yang terlalu panjang atau rumit</li>
                    <li>Pertimbangkan kategori yang sering dibutuhkan siswa</li>
                    <li>Contoh: Fasilitas, Akademik, Ekstrakurikuler, dll</li>
                </ul>
            </div>
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
    display:grid;
    grid-template-columns:1fr 350px;
    gap:30px;
}

/* Form Box */
.form-box{
    background:white;
    border-radius:16px;
    padding:30px;
    box-shadow:0 10px 25px rgba(0,0,0,.05);
}

.form-box h2{
    margin-bottom:8px;
    color:#1e293b;
}

.kategori-form{
    display:flex;
    flex-direction:column;
    gap:24px;
}

.form-group{
    display:flex;
    flex-direction:column;
    gap:8px;
}

.form-group label{
    font-weight:600;
    color:#374151;
    font-size:14px;
}

.form-group input,
.form-group textarea{
    padding:12px 16px;
    border:1px solid #e5e7eb;
    border-radius:8px;
    font-size:14px;
    transition:.3s;
    font-family:inherit;
}

.form-group input:focus,
.form-group textarea:focus{
    outline:none;
    border-color:#2563eb;
    box-shadow:0 0 0 3px rgba(37,99,235,0.1);
}

.form-group textarea{
    resize:vertical;
    min-height:100px;
}

.form-help{
    color:#64748b;
    font-size:12px;
}

.form-actions{
    display:flex;
    gap:12px;
    margin-top:16px;
}

.btn-back,
.btn-cancel,
.btn-submit{
    padding:12px 20px;
    border-radius:8px;
    font-weight:600;
    font-size:14px;
    cursor:pointer;
    transition:.3s;
    border:none;
    text-decoration:none;
    display:inline-flex;
    align-items:center;
    justify-content:center;
}

.btn-back{
    background:#f3f4f6;
    color:#374151;
}

.btn-back:hover{
    background:#e5e7eb;
}

.btn-cancel{
    background:#fef3c7;
    color:#92400e;
}

.btn-cancel:hover{
    background:#fde68a;
}

.btn-submit{
    background:#2563eb;
    color:white;
}

.btn-submit:hover{
    background:#1d4ed8;
    transform:translateY(-2px);
}

/* Info Box */
.info-box{
    background:#f0f9ff;
    border:1px solid #bae6fd;
    border-radius:16px;
    padding:24px;
    height:fit-content;
}

.info-box h3{
    margin-bottom:16px;
    color:#0369a1;
    font-size:16px;
}

.info-box ul{
    list-style:none;
    color:#0c4a6e;
    font-size:14px;
    line-height:1.6;
}

.info-box li{
    margin-bottom:12px;
    padding-left:20px;
    position:relative;
}

.info-box li:before{
    content:"•";
    position:absolute;
    left:0;
    color:#0ea5e9;
    font-weight:bold;
}

/* Responsive */
@media(max-width:900px){
    .sidebar{width:200px}
    .main{margin-left:200px;width:calc(100% - 200px)}
}

@media(max-width:768px){
    .sidebar{display:none}
    .main{margin-left:0;width:100%}
    
    .content{
        grid-template-columns:1fr;
        gap:20px;
    }
    
    .form-box{
        padding:20px;
    }
    
    .form-actions{
        flex-direction:column;
    }
    
    .btn-cancel,
    .btn-submit{
        width:100%;
    }
}
</style>

</body>
</html>
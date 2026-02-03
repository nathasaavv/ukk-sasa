<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Kategori</title>
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
            <h1>Manajemen Kategori</h1>
            <div style="display:flex;align-items:center;gap:15px;">
                <a href="{{ route('kategori.create') }}" class="btn-create">+ Tambah Kategori</a>
                <div class="profile">
                    <div class="avatar"></div>
                    <span>Admin</span>
                </div>
            </div>
        </header>

        <section class="content">
            <!-- Statistics Cards -->
            <div class="cards">
                <div class="card">
                    <h3>Total Kategori</h3>
                    <p>5</p>
                </div>
                <div class="card">
                    <h3>Total Aspirasi</h3>
                    <p>23</p>
                </div>
                <div class="card">
                    <h3>Kategori Aktif</h3>
                    <p>4</p>
                </div>
            </div>

            <!-- Table -->
            <div class="table-box">
                <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;">
                    <h2>Daftar Kategori</h2>
                    <div style="display:flex;gap:10px;">
                        <input type="text" id="searchInput" placeholder="Cari kategori..." style="padding:8px 12px;border:1px solid #e5e7eb;border-radius:8px;">
                        <select id="sortSelect" style="padding:8px 12px;border:1px solid #e5e7eb;border-radius:8px;">
                            <option value="newest">Terbaru</option>
                            <option value="oldest">Terlama</option>
                            <option value="name">Nama A-Z</option>
                            <option value="aspirasi">Terbanyak</option>
                        </select>
                    </div>
                </div>
                <table id="kategoriTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kategori</th>
                            <th>Jumlah Aspirasi</th>
                            <th>Dibuat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
    @forelse ($kategori as $item)
    <tr>
        <td>{{ $loop->iteration }}</td>

        <td>
            <strong>{{ $item->nama }}</strong>
        </td>

        <td>
            <span class="badge {{ $item->aspirasi_count ?? 0 > 0 ? 'done' : 'pending' }}">
                {{ $item->aspirasi_count ?? 0 }} aspirasi
            </span>
        </td>

        <td>
           
        </td>

        <td>
            <div style="display:flex;gap:8px;">
                <a href="{{ route('kategori.show', $item->id) }}"
                   style="padding:6px 12px;background:#0ea5e9;color:white;text-decoration:none;border-radius:6px;font-size:12px;">
                    Lihat
                </a>

                <a href="#"
                   style="padding:6px 12px;background:#f59e0b;color:white;text-decoration:none;border-radius:6px;font-size:12px;">
                    Edit
                </a>

                <form action="{{ route('kategori.destroy', $item->id) }}"
                      method="POST"
                      onsubmit="return confirm('Apakah Anda yakin ingin menghapus kategori ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                            style="padding:6px 12px;background:#ef4444;color:white;border:none;border-radius:6px;font-size:12px;cursor:pointer;">
                        Hapus
                    </button>
                </form>
            </div>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="5" style="text-align:center;padding:20px;color:#64748b;">
            Belum ada kategori
        </td>
    </tr>
    @endforelse
</tbody>

                </table>
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
}

.cards{
    display:grid;
    grid-template-columns:repeat(auto-fit,minmax(220px,1fr));
    gap:20px;
}

.card{
    background:white;
    padding:20px;
    border-radius:16px;
    box-shadow:0 10px 25px rgba(0,0,0,.05);
}

.card h3{
    font-size:14px;
    color:#64748b;
}

.card p{
    font-size:28px;
    font-weight:700;
    margin-top:8px;
}

.table-box{
    background:white;
    margin-top:30px;
    border-radius:16px;
    padding:20px;
    box-shadow:0 10px 25px rgba(0,0,0,.05);
}

.table-box h2{
    margin-bottom:15px;
}

table{
    width:100%;
    border-collapse:collapse;
}

table th,table td{
    text-align:left;
    padding:12px;
    border-bottom:1px solid #e5e7eb;
}

table th{
    background:#f8fafc;
    font-weight:600;
    color:#374151;
}

.badge{
    padding:6px 12px;
    border-radius:20px;
    font-size:12px;
    font-weight:600;
}

.badge.pending{background:#fef3c7;color:#92400e;}
.badge.done{background:#dcfce7;color:#166534;}

.btn-create{
    background:#2563eb;
    color:white;
    padding:10px 16px;
    border-radius:10px;
    text-decoration:none;
    font-weight:600;
    font-size:14px;
    transition:.3s;
}

.btn-create:hover{
    background:#1d4ed8;
    transform:translateY(-2px);
}

@media(max-width:900px){
    .sidebar{width:200px}
    .main{margin-left:200px;width:calc(100% - 200px)}
}

@media(max-width:700px){
    .sidebar{display:none}
    .main{margin-left:0;width:100%}
}

/* Responsive table */
@media(max-width:768px){
    .table-box{
        overflow-x:auto;
    }
    
    table{
        min-width:600px;
    }
}
</style>

<script>
// Search functionality
document.getElementById('searchInput').addEventListener('input', function(e) {
    const searchTerm = e.target.value.toLowerCase();
    const rows = document.querySelectorAll('#kategoriTable tbody tr');
    
    rows.forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(searchTerm) ? '' : 'none';
    });
});

// Sort functionality
document.getElementById('sortSelect').addEventListener('change', function(e) {
    const sortValue = e.target.value;
    const tbody = document.querySelector('#kategoriTable tbody');
    const rows = Array.from(tbody.querySelectorAll('tr'));
    
    rows.sort((a, b) => {
        switch(sortValue) {
            case 'name':
                return a.cells[1].textContent.localeCompare(b.cells[1].textContent);
            case 'aspirasi':
                const countA = parseInt(a.cells[2].textContent);
                const countB = parseInt(b.cells[2].textContent);
                return countB - countA;
            case 'oldest':
                return new Date(a.cells[3].textContent) - new Date(b.cells[3].textContent);
            case 'newest':
            default:
                return new Date(b.cells[3].textContent) - new Date(a.cells[3].textContent);
        }
    });
    
    rows.forEach(row => tbody.appendChild(row));
});
</script>
</body>
</html>
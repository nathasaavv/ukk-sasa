<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
   <!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

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

.menu a:hover{
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

.badge{
    padding:6px 12px;
    border-radius:20px;
    font-size:12px;
    font-weight:600;
}

.badge.pending{background:#fef3c7;color:#92400e;}
.badge.done{background:#dcfce7;color:#166534;}

@media(max-width:900px){
    .sidebar{width:200px}
    .main{margin-left:200px;width:calc(100% - 200px)}
}

@media(max-width:700px){
    .sidebar{display:none}
    .main{margin-left:0;width:100%}
}

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

</style>
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
            <a href="{{ route('kategori.index') }}">Kategori</a>
            <a href="#">Admin</a>
            <a href="#">Logout</a>
        </nav>
    </aside>

    <!-- Main -->   
    <div class="main">

        <header class="header">
            <h1>Dashboard</h1>
            <div style="display:flex;align-items:center;gap:15px;">
                <a href="#" class="btn-create">+ Create Aspirasi</a>
                <div class="profile">
                    <div class="avatar"></div>
                    <span>Admin</span>
                </div>
            </div>
        </header>

        <section class="content">

            <!-- Cards -->
            <div class="cards">
                <div class="card">
                    <h3>Total Aspirasi</h3>
                    <p>120</p>
                </div>
                <div class="card">
                    <h3>Pending</h3>
                    <p>35</p>
                </div>
                <div class="card">
                    <h3>Selesai</h3>
                    <p>85</p>
                </div>
                <div class="card">
                    <h3>Total Siswa</h3>
                    <p>540</p>
                </div>
            </div>

            <!-- Table -->
            <div class="table-box">
                <h2>Data Aspirasi Terbaru</h2>
                <table>
                    <tr>
                        <th>Nama</th>
                        <th>Judul</th>
                        <th>Status</th>
                    </tr>
                    <tr>
                        <td>Andi</td>
                        <td>Perbaikan WC</td>
                        <td><span class="badge pending">Pending</span></td>
                    </tr>
                    <tr>
                        <td>Siti</td>
                        <td>Kantin Sehat</td>
                        <td><span class="badge done">Selesai</span></td>
                    </tr>
                </table>
            </div>

        </section>
    </div>

</div>

</body>
</html>


</body>
</html>

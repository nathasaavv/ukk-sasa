<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Pilih Peran — Login</title>
  <style>
    body{font-family:'Segoe UI',Tahoma,Arial;background:linear-gradient(135deg,#667eea 0%,#764ba2 100%);min-height:100vh;display:flex;align-items:center;justify-content:center;padding:20px}
    .card{background:#fff;border-radius:14px;padding:28px;max-width:820px;width:100%;box-shadow:0 20px 50px rgba(2,6,23,.25);display:flex;gap:20px;align-items:center;justify-content:space-between}
    .intro{flex:1;padding-right:20px}
    .intro h1{font-size:22px;margin-bottom:6px;color:#0f172a}
    .intro p{color:#475569}
    .choices{display:flex;gap:16px;flex:1;justify-content:center}
    .choice{width:220px;background:linear-gradient(180deg,#fafafa,#fff);border-radius:12px;padding:18px;text-align:center;cursor:pointer;box-shadow:0 8px 30px rgba(2,6,23,.08);transition:all .18s ease;border:2px solid transparent}
    .choice:hover{transform:translateY(-6px);box-shadow:0 20px 40px rgba(2,6,23,.12)}
    .choice.active{border-color:#667eea}
    .choice .icon{font-size:34px;margin-bottom:10px}
    .choice .title{font-weight:700;color:#0f172a;margin-bottom:6px}
    .choice .desc{color:#6b7280;font-size:13px}
    .btn-choose{display:inline-block;margin-top:14px;padding:10px 14px;border-radius:8px;background:#667eea;color:#fff;text-decoration:none;font-weight:700}
    @media(max-width:720px){.card{flex-direction:column}.choices{flex-direction:column}}
  </style>
</head>
<body>
  <div class="card">
    <div class="intro">
      <h1>Masuk sebagai</h1>
      <p>Pilih apakah Anda ingin masuk sebagai <strong>Admin</strong> (email + password) atau <strong>Siswa</strong> (NIS + password).</p>
    </div>

    <div class="choices">
      <a href="{{ route('login', ['role' => 'admin']) }}" class="choice" id="choice-admin">
        <div class="icon">⚙️</div>
        <div class="title">Admin</div>
        <div class="desc">Masuk menggunakan email & password</div>
        <div style="margin-top:12px;"><span class="btn-choose">Buka Form Admin</span></div>
      </a>

      <a href="{{ route('login', ['role' => 'siswa']) }}" class="choice" id="choice-siswa">
        <div class="icon">👩‍🎓</div>
        <div class="title">Siswa</div>
        <div class="desc">Masuk menggunakan NIS (tanpa password)</div>
        <div style="margin-top:12px;"><span class="btn-choose">Buka Form Siswa</span></div>
      </a>
    </div>
  </div>
</body>
</html>

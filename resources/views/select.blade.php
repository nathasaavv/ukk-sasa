<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Pilih Peran — Login</title>
  <style>
    body{font-family:'Segoe UI',Tahoma,Arial;background:linear-gradient(135deg,#2563eb 0%,#1d4ed8 100%);min-height:100vh;display:flex;align-items:center;justify-content:center;padding:28px;position:relative}
    /* subtle dim so the central card pops on top of the strong gradient */
    body::before{content:"";position:fixed;inset:0;background:rgba(11,17,32,0.06);pointer-events:none;backdrop-filter:saturate(.95);}

    /* Main card (dashboard-style) — stronger contrast for readability */
    .card{width:760px;max-width:96%;background:rgba(255,255,255,0.96);color:#0b1220;backdrop-filter:blur(4px);border-radius:14px;box-shadow:0 30px 70px rgba(2,6,23,.18);overflow:visible;padding:22px;border:1px solid rgba(2,6,23,0.06);position:relative;animation:cardIn .36s cubic-bezier(.2,.9,.2,1) both}
    .card::before{display:none}

    .card-header{text-align:center;padding:18px 8px 14px;margin-top:6px}
    .card-header h1{font-size:20px;margin:0;color:#0b1220;font-weight:800}
    .card-header p{margin:8px 0 0;color:#475569;font-size:13px;max-width:680px;margin-left:auto;margin-right:auto;line-height:1.5}

    @keyframes cardIn{from{opacity:0;transform:translateY(8px) scale(.995)}to{opacity:1;transform:none}}

    /* option row (icons like contoh) */
    .option-row{display:flex;gap:28px;justify-content:center;align-items:flex-start;margin-top:20px}

    .option{width:112px;display:flex;flex-direction:column;align-items:center;gap:10px;text-decoration:none;color:inherit}
    .option-button{width:88px;height:88px;border-radius:999px;display:flex;align-items:center;justify-content:center;background:var(--surface);border:1px solid rgba(99,102,241,.14);box-shadow:0 8px 24px rgba(2,6,23,.04);transition:transform .18s ease,box-shadow .18s ease,border-color .18s ease;cursor:pointer;position:relative}
    .dark .option-button{background:rgba(255,255,255,0.02);border-color:rgba(255,255,255,0.04)}
    .option-button::after{content:"";position:absolute;inset: -6px;border-radius:999px;opacity:0;transition:opacity .18s ease,transform .18s ease}
    .option-button .emoji{font-size:34px}
    .option-label{font-size:12px;color:#9aa4b2;letter-spacing:1px;text-transform:uppercase;transition:color .18s ease,transform .18s ease}

    /* hover / touch / focus effects */
    .option-button:hover{transform:translateY(-4px) scale(1.03);box-shadow:0 18px 36px rgba(2,6,23,.10)}
    .option:active .option-button{transform:translateY(-2px) scale(1.015);box-shadow:0 12px 28px rgba(2,6,23,.08)}
    .option:focus-visible .option-button{outline:3px solid rgba(102,126,234,.12);outline-offset:4px}

    /* Admin-specific: keep hover/active but remove blue focus ring */
    .option.admin .option-button:hover{transform:translateY(-4px) scale(1.03);box-shadow:0 18px 36px rgba(2,6,23,.10)}
    .option.admin:hover .option-button{transform:translateY(-4px) scale(1.03);box-shadow:0 18px 36px rgba(2,6,23,.10)}
    .option.admin:active .option-button{transform:translateY(-2px) scale(1.015);box-shadow:0 12px 28px rgba(2,6,23,.08)}
    .option.admin:focus-visible .option-button{outline:0;box-shadow:0 12px 24px rgba(2,6,23,.06)}
    .option.admin[aria-pressed="true"] .option-button{border:1px solid rgba(99,102,241,.14);box-shadow:0 12px 28px rgba(2,6,23,.08);transform:translateY(-4px);background:var(--surface)}
    .option.admin[aria-pressed="true"] .option-button::after{opacity:0;transform:none}
    .option.admin[aria-pressed="true"] .option-label{color:#667eea;font-weight:700}

    .option[aria-pressed="true"] .option-button{box-shadow:0 16px 36px rgba(102,126,234,.20);border:4px solid rgba(102,126,234,.36);transform:translateY(-6px);background:linear-gradient(180deg,rgba(255,255,255,0.04),rgba(255,255,255,0))}
    .dark .option[aria-pressed="true"] .option-button{background:linear-gradient(180deg,rgba(255,255,255,0.02),rgba(255,255,255,0))}

    /* active uses same primary palette as login */
    .option[aria-pressed="true"] .option-button{box-shadow:0 16px 36px rgba(102,126,234,.20);border:4px solid rgba(102,126,234,.36);transform:translateY(-6px);background:linear-gradient(180deg, rgba(255,255,255,0.04), rgba(255,255,255,0))}
    .dark .option[aria-pressed="true"] .option-button{background:linear-gradient(180deg, rgba(255,255,255,0.02), rgba(255,255,255,0))}
    .option[aria-pressed="true"] .option-button::after{opacity:1;transform:scale(1);background:radial-gradient(circle at center, rgba(102,126,234,.14), rgba(102,126,234,0));}
    .option[aria-pressed="true"] .option-label{color:#667eea;font-weight:700}

    .help-text{text-align:center;margin-top:18px;color:rgba(15,23,42,.45);font-size:13px}

    @media (max-width:560px){.option-row{gap:16px}.option{width:80px}.option-button{width:72px;height:72px}.card{padding:18px}}
  </style>
</head>
<body>
  <div class="card">
    <div class="card-header">
      <h1>Masuk sebagai</h1>
      <p>Pilih peran Anda untuk melanjutkan ke halaman login. Siswa akan masuk menggunakan <strong>NIS</strong>, Admin menggunakan <strong>email</strong>.</p>
    </div>

    <div class="card-body">
      <div class="option-row" role="list">
        <a role="listitem" href="{{ route('login', ['role' => 'admin']) }}" class="option admin" aria-pressed="{{ request('role', 'admin') === 'admin' ? 'true' : 'false' }}">
          <div class="option-button"><span class="emoji">⚙️</span></div>
          <div class="option-label">Admin</div>
        </a>

        <a role="listitem" href="{{ route('login', ['role' => 'siswa']) }}" class="option" aria-pressed="{{ request('role', 'admin') === 'siswa' ? 'true' : 'false' }}">
          <div class="option-button"><span class="emoji">👩‍🎓</span></div>
          <div class="option-label">Siswa</div>
        </a>
      </div>

      <div class="help-text">Klik kartu yang sesuai — tampilan login akan otomatis menyesuaikan.</div>
    </div>
  </div>
</body>
</html>

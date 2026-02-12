<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Aplikasi Aspirasi Siswa</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .login-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            overflow: hidden;
            max-width: 450px;
            width: 100%;
            animation: slideIn 0.5s ease-out;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 40px 30px;
            text-align: center;
        }

        .login-header h1 {
            font-size: 28px;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .login-header p {
            font-size: 14px;
            opacity: 0.9;
        }

        .logo-icon {
            font-size: 48px;
            margin-bottom: 15px;
            display: block;
        }

        .login-form {
            padding: 40px 30px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .form-group input:focus {
            outline: none;
            border-color: #667eea;
            box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1);
        }

        .form-group input::placeholder {
            color: #999;
        }

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            font-size: 13px;
        }

        .remember-forgot a {
            color: #667eea;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .remember-forgot a:hover {
            color: #764ba2;
            text-decoration: underline;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .checkbox-group input[type="checkbox"] {
            width: auto;
            cursor: pointer;
        }

        .checkbox-group label {
            margin: 0;
            font-weight: 500;
            color: #666;
            cursor: pointer;
        }

        .btn-login {
            width: 100%;
            padding: 12px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(102, 126, 234, 0.6);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .login-footer {
            text-align: center;
            padding: 20px 30px;
            border-top: 1px solid #f0f0f0;
            background: #fafafa;
            font-size: 14px;
            color: #666;
        }

        .login-footer a {
            color: #667eea;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .login-footer a:hover {
            color: #764ba2;
        }

        .error-message {
            background: #fee;
            color: #c33;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 13px;
            border-left: 4px solid #c33;
        }

        .success-message {
            background: #efe;
            color: #3c3;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 13px;
            border-left: 4px solid #3c3;
        }

        .input-icon-group {
            position: relative;
        }

        .input-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #999;
            pointer-events: none;
        }

        /* Responsive */
        @media (max-width: 480px) {
            .login-container {
                border-radius: 10px;
            }

            .login-header {
                padding: 30px 20px;
            }

            .login-header h1 {
                font-size: 24px;
            }

            .logo-icon {
                font-size: 40px;
            }

            .login-form {
                padding: 30px 20px;
            }

            .login-footer {
                padding: 15px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="login-container">
        <!-- Header -->
        <div class="login-header">
            <span class="logo-icon">🎓</span>
            <h1>Aplikasi Aspirasi</h1>
            <p>Sistem Manajemen Aspirasi Siswa</p>
        </div>

        <!-- Form -->
        <form class="login-form" action="{{ route('login.authenticate') }}" method="POST" id="mainLoginForm">
            @csrf

            {{-- role selector (admin | siswa) --}}
            @php $initialRole = old('role', $role ?? 'admin'); @endphp
            <div class="form-group" style="margin-bottom:18px;">
                <label>Pilih peran</label>
                <div style="display:flex;gap:8px;margin-top:8px;">
                    <button type="button" class="btn" id="roleAdminBtn" style="background:{{ $initialRole==='admin' ? '#667eea' : '#f1f5f9' }};color:{{ $initialRole==='admin' ? '#fff' : '#374151' }};">Admin</button>
                    <button type="button" class="btn" id="roleSiswaBtn" style="background:{{ $initialRole==='siswa' ? '#667eea' : '#f1f5f9' }};color:{{ $initialRole==='siswa' ? '#fff' : '#374151' }};">Siswa</button>
                </div>
                <input type="hidden" name="role" id="roleInput" value="{{ $initialRole }}">
            </div>

            {{-- Error Messages --}}
            @if ($errors->has('email') || $errors->has('password') || $errors->has('nis'))
                <div class="error-message">
                    @if ($errors->has('email'))
                        {{ $errors->first('email') }}<br>
                    @endif
                    @if ($errors->has('nis'))
                        {{ $errors->first('nis') }}<br>
                    @endif
                    @if ($errors->has('password'))
                        {{ $errors->first('password') }}
                    @endif
                </div>
            @endif

            {{-- Success Message --}}
            @if (session('success'))
                <div class="success-message">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Admin: Email / Siswa: NIS -->
            <div class="form-group" id="emailGroup">
                <label for="email">Email atau Username</label>
                <div class="input-icon-group">
                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="Masukkan email atau username Anda"
                        value="{{ old('email') }}"
                        autocomplete="username"
                    />
                    <span class="input-icon">📧</span>
                </div>
            </div>

            <div class="form-group" id="nisGroup" style="display:none;">
                <label for="nis">NIS</label>
                <div class="input-icon-group">
                    <input
                        type="text"
                        id="nis"
                        name="nis"
                        placeholder="Masukkan NIS Anda"
                        value="{{ old('nis') }}"
                        autocomplete="username"
                    />
                    <span class="input-icon">🆔</span>
                </div>
            </div>

            <!-- Password Field (only for admin) -->
            <div class="form-group" id="passwordGroup">
                <label for="password">Password</label>
                <div class="input-icon-group">
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Masukkan password Anda"
                    />
                    <span class="input-icon">🔒</span>
                </div>
                <small id="passwordHint" style="display:block;margin-top:6px;color:#6b7280;font-size:13px;">(Hanya diperlukan untuk Admin)</small>
            </div>

            <!-- Remember & Forgot Password -->
            <div class="remember-forgot">
                <div class="checkbox-group">
                    <input type="checkbox" id="remember" name="remember" value="1">
                    <label for="remember">Ingat saya</label>
                </div>
                <a href="#forgot-password">Lupa password?</a>
            </div>

            <!-- Login Button -->
            <button type="submit" class="btn-login">Masuk</button>
        </form>

        <script>
            (function(){
                const roleInput = document.getElementById('roleInput');
                const roleAdminBtn = document.getElementById('roleAdminBtn');
                const roleSiswaBtn = document.getElementById('roleSiswaBtn');
                const emailGroup = document.getElementById('emailGroup');
                const nisGroup = document.getElementById('nisGroup');
                const emailInput = document.getElementById('email');
                const nisInput = document.getElementById('nis');

                function setRole(role){
                    roleInput.value = role;

                    if(role === 'siswa'){
                        // show nis, hide email
                        nisGroup.style.display = '';
                        emailGroup.style.display = 'none';
                        nisInput && nisInput.setAttribute('required','');
                        emailInput && emailInput.removeAttribute('required');

                        roleAdminBtn.style.background = '#f1f5f9';
                        roleAdminBtn.style.color = '#374151';
                        roleSiswaBtn.style.background = '#667eea';
                        roleSiswaBtn.style.color = '#fff';
                    } else {
                        nisGroup.style.display = 'none';
                        emailGroup.style.display = '';
                        emailInput && emailInput.setAttribute('required','');
                        nisInput && nisInput.removeAttribute('required');

                        roleAdminBtn.style.background = '#667eea';
                        roleAdminBtn.style.color = '#fff';
                        roleSiswaBtn.style.background = '#f1f5f9';
                        roleSiswaBtn.style.color = '#374151';
                    }
                }

                roleAdminBtn.addEventListener('click', ()=> setRole('admin'));
                roleSiswaBtn.addEventListener('click', ()=> setRole('siswa'));

                // initialise from server-provided value
                setRole(roleInput.value || 'admin');
            })();
        </script>

        <!-- Footer -->
        <div class="login-footer">
            Belum punya akun? <a href="#register">Hubungi Admin</a>
        </div>
    </div>
</body>
</html>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Aplikasi Aspirasi Siswa</title>
    <style>
        /* reset + base */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Inter', system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
        }

        body {
            background-color: #0b1220;
            color: #f3f4f6;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .login-container {
            background-color: #1f2937; /* card-dark */
            color: #f3f4f6;
            border-radius: 0.75rem;
            box-shadow: 0 30px 80px rgba(2,6,23,0.18);
            max-width: 450px;
            width: 100%;
            overflow: hidden;
            animation: slideIn 0.5s ease-out;
            border: 1px solid #374151;
        }

        @keyframes slideIn {
            from { opacity: 0; transform: translateY(-30px); }
            to { opacity: 1; transform: translateY(0); }
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
            background-color: #111827;
            color: #f3f4f6;
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
            color: #f3f4f6;
            margin-bottom: 8px;
            font-size: 14px;
        }

        .form-group input {
            width: 100%;
            padding: 12px 15px;
            border: 2px solid #374151;
            border-radius: 8px;
            background-color: #1f2937;
            color: #f3f4f6;
            font-size: 14px;
            transition: all 0.3s ease;
        }

        .form-group input:focus {
            outline: none;
            border-color: #10b981;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.1);
        }

        .form-group input::placeholder {
            color: #9ca3af;
        }

        .remember-forgot {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            font-size: 13px;
        }

        .remember-forgot a {
            color: #10b981;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .remember-forgot a:hover {
            color: #059669;
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
            color: #9ca3af;
            cursor: pointer;
        }

        .btn-login {
            width: 100%;
            padding: 12px;
            background-color: #10b981;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(16, 185, 129, 0.4);
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.6);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .login-footer {
            text-align: center;
            padding: 20px 30px;
            border-top: 1px solid #374151;
            background: #111827;
            font-size: 14px;
            color: #9ca3af;
        }

        .login-footer a {
            color: #10b981;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .login-footer a:hover {
            color: #059669;
        }

        .error-message {
            background: #3f0000;
            color: #fee;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 13px;
            border-left: 4px solid #c33;
        }

        .success-message {
            background: #0f2f0f;
            color: #6ee7b7;
            padding: 12px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 13px;
            border-left: 4px solid #10b981;
        }

        .input-icon-group {
            position: relative;
        }

        .input-icon {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            color: #9ca3af;
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

            @php $initialRole = old('role', $role ?? 'admin'); @endphp
            <!-- role handled on "Pilih Peran" page; keep role value as hidden input -->
            <input type="hidden" name="role" id="roleInput" value="{{ $initialRole }}">

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
            <div class="form-group" id="emailGroup" style="{{ $initialRole === 'siswa' ? 'display:none;' : '' }}">
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

            <div class="form-group" id="nisGroup" style="{{ $initialRole === 'siswa' ? '' : 'display:none;' }}">
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
            <div class="form-group" id="passwordGroup" style="{{ $initialRole === 'siswa' ? 'display:none;' : '' }}">
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
                <small id="passwordHint" style="display:block;margin-top:6px;color:#9ca3af;font-size:13px;">(Hanya diperlukan untuk Admin)</small>
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


        <!-- Footer -->
        <div class="login-footer">
            Belum punya akun? <a href="#register">Hubungi Admin</a>
        </div>
    </div>
</body>
</html>

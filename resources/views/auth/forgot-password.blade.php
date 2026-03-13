<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - Aspirasi Siswa</title>
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('images/favicon.png') }}">
    
    <style>
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
            background-color: #1f2937;
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

        .login-header {
            background-color: #111827;
            color: #f3f4f6;
            padding: 40px 30px;
            text-align: center;
        }

        .login-header h1 {
            font-size: 24px;
            margin-bottom: 10px;
            font-weight: 700;
        }

        .login-header p {
            font-size: 14px;
            opacity: 0.7;
            line-height: 1.5;
        }

        .logo-icon {
            font-size: 48px;
            margin-bottom: 15px;
            display: block;
        }

        .login-form {
            padding: 30px;
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
    </style>
</head>
<body>
    <div class="login-container">
        <div class="login-header">
            <span class="logo-icon">🔑</span>
            <h1>Lupa Password?</h1>
            <p>Masukkan email yang terdaftar. Kami akan mengirimkan link untuk mereset password Anda.</p>
        </div>

        <form class="login-form" action="{{ route('password.email') }}" method="POST">
            @csrf

            @if ($errors->has('email'))
                <div class="error-message">
                    {{ $errors->first('email') }}
                </div>
            @endif

            @if (session('status'))
                <div class="success-message">
                    {{ session('status') }}
                </div>
            @endif

            <div class="form-group">
                <label for="email">Email Terdaftar</label>
                <div class="input-icon-group">
                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="nama@email.com"
                        value="{{ old('email') }}"
                        required
                        autofocus
                    />
                    <span class="input-icon">📧</span>
                </div>
            </div>

            <button type="submit" class="btn-login">Kirim Link Reset</button>
        </form>

        <div class="login-footer">
            Kembali ke <a href="{{ route('login') }}">Halaman Login</a>
        </div>
    </div>
</body>
</html>

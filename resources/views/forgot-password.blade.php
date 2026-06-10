<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Kata Sandi – ReGoods</title>
    <link rel="shortcut icon" href="{{ asset('images/logo/logo.jpeg') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Inter', sans-serif;
            background: #F5F5F5;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* Top green bar */
        .top-bar {
            background: linear-gradient(90deg, #03AC0E 0%, #028A0B 100%);
            height: 4px;
        }

        /* Header */
        .login-header {
            background: #fff;
            border-bottom: 1px solid #E0E0E0;
            padding: .85rem 1.5rem;
            display: flex;
            align-items: center;
            gap: .6rem;
        }
        .login-header img { width: 36px; height: 36px; border-radius: 8px; object-fit: cover; }
        .login-header .brand { font-size: 1.15rem; font-weight: 700; color: #03AC0E; }

        /* Main area */
        .login-body {
            flex: 1;
            display: flex;
            align-items: flex-start;
            justify-content: center;
            padding: 2.5rem 1rem;
        }

        /* Card */
        .login-card {
            background: #fff;
            border: 1px solid #E0E0E0;
            border-radius: 12px;
            padding: 2rem;
            width: 100%;
            max-width: 400px;
            box-shadow: 0 2px 8px rgba(0,0,0,.06);
        }

        .card-title {
            font-size: 1.2rem;
            font-weight: 700;
            color: #212121;
            margin-bottom: .25rem;
        }
        .card-subtitle {
            font-size: .8rem;
            color: #757575;
            margin-bottom: 1.5rem;
        }

        /* Error */
        .err-box {
            background: #FEF2F2;
            border: 1px solid #FECACA;
            border-radius: 8px;
            padding: .7rem 1rem;
            margin-bottom: 1.1rem;
            font-size: .82rem;
            color: #B91C1C;
        }

        /* Form fields */
        .field { margin-bottom: .9rem; }
        .field label { display: block; font-size: .8rem; font-weight: 600; color: #424242; margin-bottom: .4rem; }
        .field input {
            width: 100%;
            border: 1.5px solid #E0E0E0;
            border-radius: 8px;
            padding: .7rem .9rem;
            font-size: .88rem;
            font-family: 'Inter', sans-serif;
            color: #212121;
            outline: none;
            transition: border-color .15s, box-shadow .15s;
        }
        .field input::placeholder { color: #BDBDBD; }
        .field input:focus {
            border-color: #03AC0E;
            box-shadow: 0 0 0 3px rgba(3,172,14,.1);
        }

        /* Submit */
        .btn-submit {
            width: 100%;
            background: #03AC0E;
            color: #fff;
            border: none;
            border-radius: 8px;
            padding: .8rem;
            font-size: .95rem;
            font-weight: 700;
            font-family: 'Inter', sans-serif;
            cursor: pointer;
            transition: background .15s;
            letter-spacing: .1px;
        }
        .btn-submit:hover { background: #028A0B; }
        .btn-submit:active { background: #027008; }

        /* Links */
        .login-link {
            margin-top: 1.25rem;
            padding-top: 1rem;
            border-top: 1px solid #E0E0E0;
            text-align: center;
            font-size: .82rem;
            color: #616161;
        }
        .login-link a {
            color: #03AC0E;
            font-weight: 600;
            text-decoration: none;
        }
        .login-link a:hover {
            text-decoration: underline;
        }

        /* Tip box */
        .tip-box {
            background: #F3FFED;
            border: 1px solid #C8E6C9;
            border-radius: 8px;
            padding: .75rem 1rem;
            margin-bottom: 1.1rem;
            font-size: .78rem;
            color: #2E7D32;
            line-height: 1.4;
        }
    </style>
</head>
<body>
    <div class="top-bar"></div>

    <!-- Header -->
    <div class="login-header">
        <img src="{{ asset('images/logo/logo.jpeg') }}" alt="ReGoods">
        <span class="brand">ReGoods</span>
    </div>

    <!-- Main -->
    <div class="login-body">
        <div class="login-card">
            <h2 class="card-title">Atur Ulang Kata Sandi</h2>
            <p class="card-subtitle">Verifikasi email & nomor telepon untuk mengganti kata sandi Anda</p>

            <div class="tip-box">
                💡 <strong>Mode Demo Skripsi:</strong> Masukkan alamat email dan nomor telepon terdaftar untuk mereset kata sandi secara instan.
            </div>

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                @if($errors->any())
                    <div class="err-box">⚠️ {{ $errors->first() }}</div>
                @endif

                <!-- Email -->
                <div class="field">
                    <label for="email">Alamat Email Terdaftar</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="contoh@gmail.com" required>
                </div>

                <!-- Nomor Telepon -->
                <div class="field">
                    <label for="phone">Nomor Telepon Terdaftar</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone') }}" placeholder="Contoh: 081234567890" required>
                </div>

                <!-- Password baru -->
                <div class="field">
                    <label for="password">Kata Sandi Baru</label>
                    <input type="password" name="password" id="password" placeholder="Minimal 6 karakter" required>
                </div>

                <!-- Konfirmasi password baru -->
                <div class="field">
                    <label for="password_confirmation">Konfirmasi Kata Sandi Baru</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Ulangi kata sandi baru" required>
                </div>

                <button type="submit" class="btn-submit">Perbarui Kata Sandi</button>
            </form>

            <div class="login-link">
                Kembali ke <a href="{{ route('login') }}">Halaman Masuk</a>
            </div>
        </div>
    </div>

    <div class="login-footer">© 2025 ReGoods — Marketplace Barang Bekas Terpercaya</div>
</body>
</html>

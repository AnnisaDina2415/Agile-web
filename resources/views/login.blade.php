<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk – ReGoods</title>
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

        /* Role buttons */
        .role-row {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: .5rem;
            margin-bottom: 1.25rem;
        }
        .role-btn {
            display: flex; flex-direction: column; align-items: center;
            padding: .65rem .4rem;
            border-radius: 8px;
            border: 1.5px solid #E0E0E0;
            background: #fff;
            color: #616161;
            font-family: 'Inter', sans-serif;
            font-size: .72rem; font-weight: 600;
            cursor: pointer;
            transition: all .15s;
            gap: .2rem;
        }
        .role-btn .emoji { font-size: 1.25rem; }
        .role-btn:hover { border-color: #03AC0E; color: #03AC0E; background: #F3FFED; }
        .role-btn.active {
            border-color: #03AC0E;
            background: #F3FFED;
            color: #03AC0E;
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

        /* Remember */
        .remember { display: flex; align-items: center; gap: .5rem; margin-bottom: 1.25rem; }
        .remember input { accent-color: #03AC0E; width: 15px; height: 15px; }
        .remember label { font-size: .8rem; color: #616161; cursor: pointer; }

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

        /* Demo section */
        .demo-wrap {
            margin-top: 1.25rem;
            padding-top: 1rem;
            border-top: 1px solid #E0E0E0;
        }
        .demo-title { font-size: .72rem; font-weight: 600; color: #9E9E9E; margin-bottom: .6rem; text-align: center; }
        .demo-row {
            display: flex; align-items: center; justify-content: space-between;
            padding: .45rem .65rem;
            border-radius: 6px;
            border: 1px solid #F0F0F0;
            background: #FAFAFA;
            margin-bottom: .35rem;
        }
        .demo-role { font-size: .72rem; font-weight: 600; color: #424242; display: flex; align-items: center; gap: .3rem; }
        .demo-creds { display: flex; gap: .3rem; }
        .demo-creds code { font-size: .67rem; background: #F3FFED; border: 1px solid #C8E6C9; color: #1B5E20; padding: .1rem .4rem; border-radius: 4px; font-family: monospace; }

        /* Footer */
        .login-footer {
            text-align: center;
            padding: 1rem;
            font-size: .75rem;
            color: #9E9E9E;
        }

        /* Premium Register Choices (Tokopedia style) */
        .register-section {
            margin-top: 1.5rem;
            padding-top: 1.25rem;
            border-top: 1px dashed #E0E0E0;
            text-align: center;
        }
        .register-title {
            font-size: .82rem;
            font-weight: 600;
            color: #616161;
            margin-bottom: .75rem;
        }
        .register-choices {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: .75rem;
        }
        .register-card-btn {
            display: flex;
            align-items: center;
            gap: .5rem;
            padding: .75rem .6rem;
            border-radius: 10px;
            border: 1.5px solid #E0E0E0;
            text-decoration: none;
            background: #fff;
            transition: all .25s cubic-bezier(0.4, 0, 0.2, 1);
            cursor: pointer;
        }
        .register-card-btn:hover {
            transform: translateY(-2px);
            border-color: #03AC0E;
            box-shadow: 0 4px 12px rgba(3,172,14,.12);
            background: #F3FFED;
        }
        .register-card-btn .rc-icon {
            font-size: 1.4rem;
            flex-shrink: 0;
        }
        .register-card-btn .rc-info {
            display: flex;
            flex-direction: column;
            text-align: left;
            overflow: hidden;
        }
        .register-card-btn .rc-label {
            font-size: .8rem;
            font-weight: 700;
            color: #212121;
            transition: color .2s;
        }
        .register-card-btn .rc-desc {
            font-size: .65rem;
            color: #757575;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        .register-card-btn:hover .rc-label {
            color: #03AC0E;
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
            <h2 class="card-title">Masuk ke ReGoods</h2>

            <form method="POST" action="{{ route('login.post') }}">
                @csrf

                @if(session('success'))
                    <div style="background:#F3FFED; border:1px solid #C8E6C9; border-radius:8px; padding:.7rem 1rem; margin-bottom:1.1rem; font-size:.82rem; color:#1B5E20;">
                        ✅ {{ session('success') }}
                    </div>
                @endif

                @if($errors->any())
                    <div class="err-box">⚠️ {{ $errors->first() }}</div>
                @endif

                <input type="hidden" name="role" id="selected_role" value="{{ $selectedRole ?? 'pembeli' }}">

                <!-- Role picker -->
                <p style="font-size:.78rem; font-weight:600; color:#424242; margin-bottom:.55rem;">Masuk sebagai:</p>
                <div class="role-row">
                    <button type="button" onclick="selectRole('pembeli')" id="role_btn_pembeli" class="role-btn">
                        <span class="emoji">🛍️</span>
                        <span>Pembeli</span>
                    </button>
                    <button type="button" onclick="selectRole('penjual')" id="role_btn_penjual" class="role-btn">
                        <span class="emoji">🏪</span>
                        <span>Penjual</span>
                    </button>
                    <button type="button" onclick="selectRole('admin')" id="role_btn_admin" class="role-btn">
                        <span class="emoji">🔑</span>
                        <span>Admin</span>
                    </button>
                </div>

                <!-- Email -->
                <div class="field">
                    <label for="email_input">Alamat Email</label>
                    <input type="email" name="email" id="email_input"
                           value="{{ old('email') }}"
                           placeholder="pembeli@gmail.com"
                           required autocomplete="email">
                </div>

                <!-- Password -->
                <div class="field">
                    <label for="password_input">Kata Sandi</label>
                    <input type="password" name="password" id="password_input"
                           placeholder="Masukkan kata sandi"
                           required autocomplete="current-password">
                </div>

                <!-- Remember & Forgot Password -->
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.25rem;">
                    <div class="remember" style="margin:0;">
                        <input type="checkbox" name="remember" id="remember">
                        <label for="remember">Ingat saya</label>
                    </div>
                    <a href="{{ route('password.request') }}" style="font-size:.8rem; color:#03AC0E; text-decoration:none; font-weight:600;" onmouseover="this.style.textDecoration='underline'" onmouseout="this.style.textDecoration='none'">Lupa kata sandi?</a>
                </div>

                <button type="submit" class="btn-submit">Masuk</button>

                <div class="register-section">
                    <p class="register-title">Belum punya akun? Daftar Sekarang</p>
                    <div class="register-choices">
                        <a href="{{ route('register') }}?role=pembeli" class="register-card-btn">
                            <span class="rc-icon">🛍️</span>
                            <span class="rc-info">
                                <span class="rc-label">Pembeli</span>
                                <span class="rc-desc">Mulai Belanja</span>
                            </span>
                        </a>
                        <a href="{{ route('register') }}?role=penjual" class="register-card-btn">
                            <span class="rc-icon">🏪</span>
                            <span class="rc-info">
                                <span class="rc-label">Penjual</span>
                                <span class="rc-desc">Mulai Jualan</span>
                            </span>
                        </a>
                    </div>
                </div>
            </form>

            <!-- Demo accounts -->
            <div class="demo-wrap">
                <p class="demo-title">— Akun Demo —</p>
                <div class="demo-row">
                    <span class="demo-role">🛍️ Pembeli</span>
                    <div class="demo-creds">
                        <code>pembeli@gmail.com</code>
                        <code>password123</code>
                    </div>
                </div>
                <div class="demo-row">
                    <span class="demo-role">🏪 Penjual</span>
                    <div class="demo-creds">
                        <code>penjual@gmail.com</code>
                        <code>password123</code>
                    </div>
                </div>
                <div class="demo-row">
                    <span class="demo-role">🔑 Admin</span>
                    <div class="demo-creds">
                        <code>admin@regoods.com</code>
                        <code>password123</code>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="login-footer">© 2025 ReGoods — Marketplace Barang Bekas Terpercaya</div>

    <script>
    function selectRole(role) {
        document.getElementById('selected_role').value = role;
        document.querySelectorAll('.role-btn').forEach(b => b.classList.remove('active'));
        document.getElementById('role_btn_' + role)?.classList.add('active');
        const ph = { pembeli: 'pembeli@gmail.com', penjual: 'penjual@gmail.com', admin: 'admin@regoods.com' };
        document.getElementById('email_input').placeholder = ph[role] || 'email@example.com';
    }
    document.addEventListener('DOMContentLoaded', () => {
        selectRole(document.getElementById('selected_role').value || 'pembeli');
    });
    </script>
</body>
</html>
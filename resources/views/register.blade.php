<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun – ReGoods</title>
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
            padding: 2rem 1rem;
        }

        /* Card */
        .login-card {
            background: #fff;
            border: 1px solid #E0E0E0;
            border-radius: 12px;
            padding: 2rem;
            width: 100%;
            max-width: 450px;
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

        /* Error & Validation */
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
        .field input, .field textarea {
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
        .field textarea { resize: none; }
        .field input::placeholder, .field textarea::placeholder { color: #BDBDBD; }
        .field input:focus, .field textarea:focus {
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
            margin-top: .5rem;
        }
        .btn-submit:hover { background: #028A0B; }
        .btn-submit:active { background: #027008; }

        /* Login link */
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

        /* Footer */
        .login-footer {
            text-align: center;
            padding: 1rem;
            font-size: .75rem;
            color: #9E9E9E;
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
            <h2 class="card-title">Daftar Akun ReGoods</h2>
            <p class="card-subtitle">Silakan isi formulir di bawah ini untuk menjadi Pembeli</p>

            <form method="POST" action="{{ route('register.post') }}">
                @csrf

                @if($errors->any())
                    <div class="err-box">⚠️ {{ $errors->first() }}</div>
                @endif

                <!-- Role Selection -->
                <div class="field">
                    <label style="margin-bottom: .6rem;">Daftar Sebagai</label>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: .75rem; margin-top: .4rem; margin-bottom: 1.1rem;">
                        <label style="border: 1.5px solid #E0E0E0; background: #fff; border-radius: 12px; padding: .9rem .75rem; display: flex; flex-direction: column; align-items: center; gap: .4rem; cursor: pointer; transition: all .25s cubic-bezier(0.4, 0, 0.2, 1); text-align: center; position: relative;" id="rolePembeliLabel">
                            <input type="radio" name="role" value="pembeli" id="radio_pembeli" {{ ($selectedRole ?? 'pembeli') === 'pembeli' ? 'checked' : '' }} style="position: absolute; top: .6rem; right: .6rem; accent-color: #03AC0E; width: 16px; height: 16px; margin: 0;" onclick="selectRole('pembeli')">
                            <span style="font-size: 1.8rem; margin-bottom: .2rem;">🛍️</span>
                            <span style="font-size: .85rem; font-weight: 700; color: #212121; transition: color .2s;" class="role-title">Pembeli</span>
                            <span style="font-size: .65rem; color: #757575;">Mulai belanja barang berkualitas</span>
                        </label>
                        <label style="border: 1.5px solid #E0E0E0; background: #fff; border-radius: 12px; padding: .9rem .75rem; display: flex; flex-direction: column; align-items: center; gap: .4rem; cursor: pointer; transition: all .25s cubic-bezier(0.4, 0, 0.2, 1); text-align: center; position: relative;" id="rolePenjualLabel">
                            <input type="radio" name="role" value="penjual" id="radio_penjual" {{ ($selectedRole ?? 'pembeli') === 'penjual' ? 'checked' : '' }} style="position: absolute; top: .6rem; right: .6rem; accent-color: #03AC0E; width: 16px; height: 16px; margin: 0;" onclick="selectRole('penjual')">
                            <span style="font-size: 1.8rem; margin-bottom: .2rem;">🏪</span>
                            <span style="font-size: .85rem; font-weight: 700; color: #212121; transition: color .2s;" class="role-title">Penjual</span>
                            <span style="font-size: .65rem; color: #757575;">Buka toko & mulai berjualan</span>
                        </label>
                    </div>
                </div>

                <!-- Nama -->
                <div class="field">
                    <label for="name">Nama Lengkap</label>
                    <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Masukkan nama lengkap Anda" required>
                </div>

                <!-- Email -->
                <div class="field">
                    <label for="email">Alamat Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="contoh@gmail.com" required>
                </div>

                <!-- Nomor Telepon -->
                <div class="field">
                    <label for="phone">Nomor Telepon</label>
                    <input type="text" name="phone" id="phone" value="{{ old('phone') }}" placeholder="Contoh: 08123456789" required>
                </div>

                <!-- Alamat -->
                <div class="field">
                    <label for="address">Alamat Lengkap</label>
                    <textarea name="address" id="address" rows="3" placeholder="Masukkan alamat lengkap pengiriman Anda" required>{{ old('address') }}</textarea>
                </div>

                <!-- Password -->
                <div class="field">
                    <label for="password">Kata Sandi</label>
                    <input type="password" name="password" id="password" placeholder="Minimal 6 karakter" required>
                </div>

                <!-- Confirm Password -->
                <div class="field">
                    <label for="password_confirmation">Konfirmasi Kata Sandi</label>
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Ulangi kata sandi" required>
                </div>

                <button type="submit" class="btn-submit">Daftar Sekarang</button>
            </form>

            <div class="login-link">
                Sudah punya akun? <a href="{{ route('login') }}">Masuk</a>
            </div>
        </div>
    </div>

    <div class="login-footer">© 2025 ReGoods — Marketplace Barang Bekas Terpercaya</div>

    <script>
        function selectRole(role) {
            const labelPembeli = document.getElementById('rolePembeliLabel');
            const labelPenjual = document.getElementById('rolePenjualLabel');
            const cardSubtitle = document.querySelector('.card-subtitle');
            
            // Check radio button
            const radio = document.getElementById('radio_' + role);
            if (radio) {
                radio.checked = true;
            }

            if (role === 'pembeli') {
                labelPembeli.style.borderColor = '#03AC0E';
                labelPembeli.style.background = '#F3FFED';
                labelPembeli.style.transform = 'translateY(-2px)';
                labelPembeli.style.boxShadow = '0 4px 12px rgba(3,172,14,.08)';
                labelPembeli.querySelector('.role-title').style.color = '#03AC0E';
                
                labelPenjual.style.borderColor = '#E0E0E0';
                labelPenjual.style.background = '#fff';
                labelPenjual.style.transform = 'translateY(0)';
                labelPenjual.style.boxShadow = 'none';
                labelPenjual.querySelector('.role-title').style.color = '#212121';

                cardSubtitle.textContent = 'Silakan isi formulir di bawah ini untuk menjadi Pembeli';
            } else {
                labelPenjual.style.borderColor = '#03AC0E';
                labelPenjual.style.background = '#F3FFED';
                labelPenjual.style.transform = 'translateY(-2px)';
                labelPenjual.style.boxShadow = '0 4px 12px rgba(3,172,14,.08)';
                labelPenjual.querySelector('.role-title').style.color = '#03AC0E';
                
                labelPembeli.style.borderColor = '#E0E0E0';
                labelPembeli.style.background = '#fff';
                labelPembeli.style.transform = 'translateY(0)';
                labelPembeli.style.boxShadow = 'none';
                labelPembeli.querySelector('.role-title').style.color = '#212121';

                cardSubtitle.textContent = 'Silakan isi formulir di bawah ini untuk menjadi Penjual';
            }
        }
        document.addEventListener('DOMContentLoaded', () => {
            selectRole('{{ $selectedRole ?? 'pembeli' }}');
        });
    </script>
</body>
</html>

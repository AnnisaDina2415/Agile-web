<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ReGoods Penjual')</title>
    <link rel="shortcut icon" href="{{ asset('images/logo/logo.jpeg') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>
        * { box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #F5F5F5; color: #212121; margin: 0; }
        .toko-btn { background: #03AC0E; color: #fff; border: none; border-radius: 8px; padding: .6rem 1.25rem; font-size: .85rem; font-weight: 600; cursor: pointer; font-family: inherit; transition: background .15s; }
        .toko-btn:hover { background: #028A0B; }
    </style>
    @stack('styles')
</head>
<body class="min-h-screen antialiased">

    <!-- ===== NAVBAR PENJUAL ===== -->
    <header style="background:#fff; border-bottom:1px solid #E0E0E0; position:sticky; top:0; z-index:100; box-shadow:0 1px 4px rgba(0,0,0,.07);">
        <div style="max-width:1280px; margin:0 auto; padding:0 1.25rem; display:flex; align-items:center; gap:1rem; height:64px;">

            <!-- Logo -->
            <a href="{{ route('penjual.produk.index') }}" style="display:flex; align-items:center; gap:.6rem; text-decoration:none; flex-shrink:0;">
                <img src="{{ asset('images/logo/logo.jpeg') }}" alt="ReGoods" style="height:34px; width:34px; border-radius:8px; object-fit:cover;">
                <div>
                    <span style="font-size:1rem; font-weight:700; color:#03AC0E; display:block; line-height:1.1;">ReGoods</span>
                    <span style="font-size:.65rem; color:#757575; font-weight:500;">Panel Penjual</span>
                </div>
            </a>

            <!-- Seller Nav Links -->
            <nav style="display:flex; gap:.25rem; flex:1; justify-content:center;">
                <a href="{{ route('penjual.dashboard') }}" style="padding:.5rem .85rem; text-decoration:none; font-size:.83rem; font-weight:500; border-radius:6px; color:{{ request()->routeIs('penjual.dashboard') ? '#03AC0E' : '#212121' }}; background:{{ request()->routeIs('penjual.dashboard') ? '#F3FFED' : 'transparent' }}; transition:all .15s;"
                   onmouseover="this.style.background='#F3FFED'; this.style.color='#03AC0E';" onmouseout="if(!this.matches(':focus')) { this.style.background='{{ request()->routeIs('penjual.dashboard') ? '#F3FFED' : 'transparent' }}'; this.style.color='{{ request()->routeIs('penjual.dashboard') ? '#03AC0E' : '#212121' }}'; }">
                    Dashboard
                </a>
                <a href="{{ route('penjual.produk.index') }}" style="padding:.5rem .85rem; text-decoration:none; font-size:.83rem; font-weight:500; border-radius:6px; color:{{ request()->routeIs('penjual.produk*') ? '#03AC0E' : '#212121' }}; background:{{ request()->routeIs('penjual.produk*') ? '#F3FFED' : 'transparent' }}; transition:all .15s;"
                   onmouseover="this.style.background='#F3FFED'; this.style.color='#03AC0E';" onmouseout="if(!this.matches(':focus')) { this.style.background='{{ request()->routeIs('penjual.produk*') ? '#F3FFED' : 'transparent' }}'; this.style.color='{{ request()->routeIs('penjual.produk*') ? '#03AC0E' : '#212121' }}'; }">
                    Produk Saya
                </a>
                <a href="{{ route('pembeli.sellers.show', Auth::id() ?? 1) }}" style="padding:.5rem .85rem; text-decoration:none; font-size:.83rem; font-weight:500; border-radius:6px; color:#212121; background:transparent; transition:all .15s;"
                   onmouseover="this.style.background='#F5F5F5';" onmouseout="this.style.background='transparent';">
                    Lihat Toko
                </a>
            </nav>

            <!-- Right -->
            <div style="display:flex; align-items:center; gap:.5rem; margin-left:auto; flex-shrink:0;" data-dropdown>
                <button type="button" data-dropdown-trigger style="display:flex; align-items:center; gap:.5rem; background:transparent; border:1px solid #E0E0E0; border-radius:8px; padding:.4rem .75rem; cursor:pointer; font-family:inherit; transition:border-color .15s;"
                    onmouseover="this.style.borderColor='#03AC0E'" onmouseout="this.style.borderColor='#E0E0E0'">
                    <div style="width:28px; height:28px; background:linear-gradient(135deg,#03AC0E,#028A0B); border-radius:50%; display:flex; align-items:center; justify-content:center; color:#fff; font-size:.7rem; font-weight:700; flex-shrink:0;">
                        {{ Auth::user() ? strtoupper(substr(Auth::user()->name, 0, 1)) . strtoupper(substr(explode(' ', Auth::user()->name)[1] ?? '', 0, 1)) : 'TG' }}
                    </div>
                    <span style="font-size:.82rem; font-weight:500; color:#212121; max-width:90px; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;">{{ Auth::user()?->name ?? 'Penjual' }}</span>
                    <svg style="width:14px; height:14px; color:#757575; flex-shrink:0;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                </button>

                <div data-dropdown-menu style="position:absolute; right:1rem; top:70px; width:210px; background:#fff; border:1px solid #E0E0E0; border-radius:10px; box-shadow:0 8px 24px rgba(0,0,0,.12); display:none; z-index:200; overflow:hidden;">
                    <div style="padding:.85rem 1rem; border-bottom:1px solid #F5F5F5; background:#F9F9F9;">
                        <p style="font-size:.83rem; font-weight:600; color:#212121; margin:0;">{{ Auth::user()?->name }}</p>
                        <p style="font-size:.73rem; color:#757575; margin:.2rem 0 0;">{{ Auth::user()?->email }}</p>
                    </div>
                    <div style="padding:.5rem 0; border-bottom:1px solid #F5F5F5;">
                        <a href="{{ route('pembeli.dashboard') }}" style="display:flex; align-items:center; gap:.6rem; padding:.55rem 1rem; text-decoration:none; font-size:.82rem; color:#212121; transition:background .15s;"
                           onmouseover="this.style.background='#F5F5F5'" onmouseout="this.style.background='transparent'">
                            <svg style="width:15px; height:15px; color:#757575;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                            Mode Pembeli
                        </a>
                    </div>
                    <div style="padding:.5rem 0;">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" style="width:100%; display:flex; align-items:center; gap:.6rem; padding:.55rem 1rem; font-size:.82rem; color:#EF4444; background:transparent; border:none; cursor:pointer; font-family:inherit; text-align:left;"
                                onmouseover="this.style.background='#FEF2F2'" onmouseout="this.style.background='transparent'">
                                <svg style="width:15px; height:15px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/></svg>
                                Keluar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Content -->
    <main style="max-width:1280px; margin:0 auto; padding:1.5rem 1.25rem;">
        @yield('content')
    </main>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const dropdowns = document.querySelectorAll('[data-dropdown]');
        dropdowns.forEach(function (dropdown) {
            const trigger = dropdown.querySelector('[data-dropdown-trigger]');
            const menu = dropdown.querySelector('[data-dropdown-menu]');
            if (!trigger || !menu) return;
            trigger.addEventListener('click', function (e) {
                e.preventDefault(); e.stopPropagation();
                dropdowns.forEach(function (d) {
                    if (d !== dropdown) {
                        const m = d.querySelector('[data-dropdown-menu]');
                        if (m) m.style.display = 'none';
                    }
                });
                menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
            });
        });
        document.addEventListener('click', function (e) {
            dropdowns.forEach(function (dropdown) {
                const menu = dropdown.querySelector('[data-dropdown-menu]');
                if (menu && !dropdown.contains(e.target)) menu.style.display = 'none';
            });
        });
    });
    </script>

    @stack('scripts')
</body>
</html>

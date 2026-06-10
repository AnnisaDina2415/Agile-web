<!DOCTYPE html>
<html lang="id" style="height:100%;">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Dashboard') — ReGoods Admin</title>
    <link rel="shortcut icon" href="{{ asset('images/logo/logo.jpeg') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    <style>
        *, *::before, *::after { box-sizing: border-box; }
        html, body { height: 100%; margin: 0; }
        body { font-family: 'Inter', sans-serif; background: #F5F5F5; color: #212121; }

        ::-webkit-scrollbar { width: 5px; height: 5px; }
        ::-webkit-scrollbar-track { background: #F5F5F5; }
        ::-webkit-scrollbar-thumb { background: #BDBDBD; border-radius: 4px; }

        /* Sidebar active */
        .admin-link { display:flex; align-items:center; gap:.65rem; padding:.55rem .85rem; border-radius:8px; text-decoration:none; font-size:.82rem; font-weight:500; color:#424242; transition:all .15s; }
        .admin-link:hover { background:#F3FFED; color:#03AC0E; }
        .admin-link.active { background:#F3FFED; color:#03AC0E; font-weight:600; border-left:3px solid #03AC0E; border-radius:0 8px 8px 0; padding-left:calc(.85rem - 3px); }
        .admin-link svg { width:16px; height:16px; flex-shrink:0; }

        .section-label { font-size:.65rem; font-weight:700; color:#9E9E9E; text-transform:uppercase; letter-spacing:.8px; padding:.85rem .85rem .35rem; }

        .toko-btn { background:#03AC0E; color:#fff; border:none; border-radius:8px; padding:.55rem 1.1rem; font-size:.82rem; font-weight:600; cursor:pointer; font-family:inherit; transition:background .15s; }
        .toko-btn:hover { background:#028A0B; }
    </style>
    @stack('styles')
</head>
<body>
<div style="display:flex; height:100vh; overflow:hidden;">

    <!-- ===== SIDEBAR ===== -->
    <aside style="width:230px; flex-shrink:0; background:#fff; border-right:1px solid #E0E0E0; display:flex; flex-direction:column; overflow:hidden;">

        <!-- Brand -->
        <div style="padding:1rem 1.1rem; border-bottom:1px solid #F0F0F0; display:flex; align-items:center; gap:.6rem;">
            <div style="width:34px; height:34px; background:#03AC0E; border-radius:8px; display:flex; align-items:center; justify-content:center; flex-shrink:0;">
                <svg style="width:18px; height:18px; color:#fff;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
            </div>
            <div>
                <p style="font-size:.95rem; font-weight:700; color:#03AC0E; margin:0; line-height:1.1;">ReGoods</p>
                <p style="font-size:.65rem; color:#9E9E9E; margin:.1rem 0 0;">Panel Admin</p>
            </div>
        </div>

        <!-- Navigation -->
        <nav style="flex:1; padding:.75rem .5rem; overflow-y:auto;">
            <p class="section-label">Menu Utama</p>

            <a href="{{ route('admin.dashboard') }}" class="admin-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Dashboard
            </a>

            <p class="section-label">Pengguna</p>

            <a href="{{ route('admin.users.index') }}" class="admin-link {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                Kelola Pengguna
            </a>

            <a href="{{ route('admin.admins.index') }}" class="admin-link {{ request()->routeIs('admin.admins*') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/></svg>
                Kelola Admin
            </a>

            <a href="{{ route('admin.seller-applications.index') }}" class="admin-link {{ request()->routeIs('admin.seller-applications*') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/></svg>
                Pengajuan Penjual
            </a>

            <p class="section-label">Katalog & Transaksi</p>

            <a href="{{ route('admin.categories.index') }}" class="admin-link {{ request()->routeIs('admin.categories*') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"/></svg>
                Kelola Kategori
            </a>

            <a href="{{ route('admin.orders.index') }}" class="admin-link {{ request()->routeIs('admin.orders*') ? 'active' : '' }}">
                <svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/></svg>
                History Transaksi
            </a>
        </nav>

        <!-- Admin info + logout -->
        <div style="padding:.85rem 1rem; border-top:1px solid #F0F0F0; display:flex; align-items:center; gap:.6rem;">
            <div style="width:32px; height:32px; background:#03AC0E; border-radius:50%; display:flex; align-items:center; justify-content:center; color:#fff; font-size:.75rem; font-weight:700; flex-shrink:0;">
                {{ strtoupper(substr(Auth::guard('admin')->user()?->name ?? 'A', 0, 1)) }}
            </div>
            <div style="flex:1; min-width:0;">
                <p style="font-size:.8rem; font-weight:600; color:#212121; margin:0; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">{{ Auth::guard('admin')->user()?->name ?? 'Admin' }}</p>
                <p style="font-size:.68rem; color:#9E9E9E; margin:.1rem 0 0; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">{{ Auth::guard('admin')->user()?->email ?? '' }}</p>
            </div>
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" title="Keluar" style="background:transparent; border:none; cursor:pointer; padding:.3rem; border-radius:6px; color:#9E9E9E; transition:all .15s;"
                    onmouseover="this.style.background='#FEE2E2'; this.style.color='#EF4444'" onmouseout="this.style.background='transparent'; this.style.color='#9E9E9E'">
                    <svg style="width:16px; height:16px;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                    </svg>
                </button>
            </form>
        </div>
    </aside>

    <!-- ===== MAIN CONTENT ===== -->
    <div style="flex:1; display:flex; flex-direction:column; overflow:hidden;">

        <!-- Top Header -->
        <header style="height:56px; background:#fff; border-bottom:1px solid #E0E0E0; display:flex; align-items:center; padding:0 1.5rem; gap:1rem; flex-shrink:0; box-shadow:0 1px 3px rgba(0,0,0,.05);">
            <h1 style="font-size:.95rem; font-weight:600; color:#212121; flex:1; margin:0;">@yield('page-title', 'Dashboard')</h1>

            <!-- Search -->
            <form action="{{ route('admin.products.index') }}" method="GET" style="position:relative; margin:0;" class="hidden md:block">
                <svg style="position:absolute; left:.7rem; top:50%; transform:translateY(-50%); width:14px; height:14px; color:#9E9E9E;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari barang..." style="padding:.45rem .85rem .45rem 2.1rem; font-size:.8rem; background:#F5F5F5; border:1px solid #E0E0E0; border-radius:8px; width:220px; outline:none; font-family:inherit; color:#212121; transition:border-color .15s;"
                    onfocus="this.style.borderColor='#03AC0E'" onblur="this.style.borderColor='#E0E0E0'">
            </form>

            <!-- Admin badge -->
            <span style="font-size:.72rem; font-weight:600; background:#F3FFED; color:#03AC0E; border:1px solid #03AC0E; border-radius:6px; padding:.2rem .65rem;">Admin</span>
        </header>

        <!-- Page Content -->
        <main style="flex:1; overflow-y:auto; padding:1.5rem;">
            @if(session('success'))
                <div style="display:flex; align-items:center; gap:.75rem; background:#F3FFED; border:1px solid #A8D5AB; color:#1B5E20; padding:.75rem 1rem; border-radius:10px; margin-bottom:1rem; font-size:.83rem;">
                    <svg style="width:16px; height:16px; flex-shrink:0;" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
                    {{ session('success') }}
                </div>
            @endif
            @if(session('error'))
                <div style="display:flex; align-items:center; gap:.75rem; background:#FEF2F2; border:1px solid #FECACA; color:#991B1B; padding:.75rem 1rem; border-radius:10px; margin-bottom:1rem; font-size:.83rem;">
                    <svg style="width:16px; height:16px; flex-shrink:0;" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                    {{ session('error') }}
                </div>
            @endif
            @yield('content')
        </main>
    </div>
</div>

@stack('scripts')
</body>
</html>

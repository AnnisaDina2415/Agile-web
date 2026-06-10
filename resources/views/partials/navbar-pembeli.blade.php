@php
    $cartCount = auth()->check() && auth()->user()->cart ? auth()->user()->cart->getTotalItems() : 0;
@endphp

<!-- Tokopedia-style Navbar -->
<header style="background:#fff; border-bottom:1px solid #E0E0E0; position:sticky; top:0; z-index:100; box-shadow:0 1px 4px rgba(0,0,0,.07);">
    <div style="max-width:1280px; margin:0 auto; padding:0 1rem; display:flex; align-items:center; gap:1rem; height:64px;">

        <!-- Logo -->
        <a href="{{ route('pembeli.dashboard') }}" style="display:flex; align-items:center; gap:.5rem; text-decoration:none; flex-shrink:0;">
            <img src="{{ asset('images/logo/logo.jpeg') }}" alt="ReGoods" style="height:36px; width:36px; border-radius:8px; object-fit:cover;">
            <span style="font-size:1.1rem; font-weight:700; color:#03AC0E; letter-spacing:-.3px;">ReGoods</span>
        </a>

        <!-- Search Bar -->
        <form action="{{ route('pembeli.dashboard') }}" method="GET" style="flex:1; max-width:560px; position:relative; margin:0;">
            <input type="text" name="search" id="globalSearch" value="{{ request('search') }}" placeholder="Cari produk, kategori, penjual..."
                style="width:100%; border:1.5px solid #03AC0E; border-radius:8px; padding:.55rem 1rem .55rem 2.75rem; font-size:.88rem; outline:none; background:#fff; color:#212121; font-family:inherit; transition:box-shadow .2s;"
                onfocus="this.style.boxShadow='0 0 0 3px rgba(3,172,14,.12)'"
                onblur="this.style.boxShadow='none'">
            <svg style="position:absolute; left:.8rem; top:50%; transform:translateY(-50%); width:16px; height:16px; color:#757575;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
        </form>

        <!-- Right Actions -->
        <div style="display:flex; align-items:center; gap:.25rem; margin-left:auto; flex-shrink:0;">

            <!-- Cart -->
            <a href="{{ route('pembeli.cart.index') }}" style="position:relative; display:flex; flex-direction:column; align-items:center; padding:.5rem .75rem; text-decoration:none; color:#212121; border-radius:8px; transition:background .15s;"
               onmouseover="this.style.background='#F5F5F5'" onmouseout="this.style.background='transparent'">
                <svg style="width:22px; height:22px; color:#212121;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z"/>
                </svg>
                @if($cartCount > 0)
                <span style="position:absolute; top:4px; right:6px; background:#03AC0E; color:#fff; font-size:.6rem; font-weight:700; border-radius:999px; min-width:16px; height:16px; display:flex; align-items:center; justify-content:center; padding:0 4px;" id="cartBadge">{{ $cartCount }}</span>
                @else
                <span style="position:absolute; top:4px; right:6px; background:#03AC0E; color:#fff; font-size:.6rem; font-weight:700; border-radius:999px; min-width:16px; height:16px; display:none; align-items:center; justify-content:center; padding:0 4px;" id="cartBadge">0</span>
                @endif
                <span style="font-size:.65rem; color:#757575; margin-top:1px;">Keranjang</span>
            </a>

            <!-- Chat -->
            <a href="{{ route('chat.index') }}" style="position:relative; display:flex; flex-direction:column; align-items:center; padding:.5rem .75rem; text-decoration:none; color:#212121; border-radius:8px; transition:background .15s;"
               onmouseover="this.style.background='#F5F5F5'" onmouseout="this.style.background='transparent'">
                <svg style="width:22px; height:22px; color:#212121;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"/>
                </svg>
                <span id="unreadBadge" style="position:absolute; top:4px; right:6px; background:#03AC0E; color:#fff; font-size:.6rem; font-weight:700; border-radius:999px; min-width:16px; height:16px; display:none; align-items:center; justify-content:center; padding:0 4px;">0</span>
                <span style="font-size:.65rem; color:#757575; margin-top:1px;">Chat</span>
            </a>

            <!-- Profile Dropdown -->
            <div style="position:relative;" data-dropdown>
                <button type="button" data-dropdown-trigger style="display:flex; flex-direction:column; align-items:center; padding:.5rem .75rem; background:transparent; border:none; cursor:pointer; border-radius:8px; transition:background .15s; font-family:inherit;"
                    onmouseover="this.style.background='#F5F5F5'" onmouseout="this.style.background='transparent'">
                    <div style="width:32px; height:32px; background:linear-gradient(135deg,#03AC0E,#028A0B); border-radius:50%; display:flex; align-items:center; justify-content:center; color:#fff; font-size:.8rem; font-weight:700;">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}{{ strtoupper(substr(explode(' ', Auth::user()->name)[1] ?? '', 0, 1)) }}
                    </div>
                    <span style="font-size:.65rem; color:#757575; margin-top:1px;">Akun</span>
                </button>

                <!-- Dropdown -->
                <div data-dropdown-menu style="position:absolute; right:0; top:calc(100% + 4px); width:220px; background:#fff; border:1px solid #E0E0E0; border-radius:10px; box-shadow:0 8px 24px rgba(0,0,0,.12); display:none; z-index:200; overflow:hidden;">
                    <div style="padding:1rem; border-bottom:1px solid #F5F5F5; background:#F9F9F9;">
                        <p style="font-size:.85rem; font-weight:600; color:#212121; margin:0; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">{{ Auth::user()->name }}</p>
                        <p style="font-size:.75rem; color:#757575; margin:.2rem 0 0; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">{{ Auth::user()->email }}</p>
                    </div>
                    <div style="padding:.5rem 0;">
                        <a href="{{ route('pembeli.profile.show') }}" style="display:flex; align-items:center; gap:.75rem; padding:.6rem 1rem; text-decoration:none; font-size:.83rem; color:#212121; transition:background .15s;"
                           onmouseover="this.style.background='#F5F5F5'" onmouseout="this.style.background='transparent'">
                            <svg style="width:16px; height:16px; color:#757575; flex-shrink:0;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Profil Saya
                        </a>
                        <a href="{{ route('pembeli.orders.index') }}" style="display:flex; align-items:center; gap:.75rem; padding:.6rem 1rem; text-decoration:none; font-size:.83rem; color:#212121; transition:background .15s;"
                           onmouseover="this.style.background='#F5F5F5'" onmouseout="this.style.background='transparent'">
                            <svg style="width:16px; height:16px; color:#757575; flex-shrink:0;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                            </svg>
                            Pesanan Saya
                        </a>
                    </div>
                    <div style="border-top:1px solid #F5F5F5; padding:.5rem 0;">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" style="width:100%; display:flex; align-items:center; gap:.75rem; padding:.6rem 1rem; font-size:.83rem; color:#EF4444; background:transparent; border:none; cursor:pointer; font-family:inherit; text-align:left; transition:background .15s;"
                                onmouseover="this.style.background='#FEF2F2'" onmouseout="this.style.background='transparent'">
                                <svg style="width:16px; height:16px; flex-shrink:0;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                                </svg>
                                Keluar
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Category nav bar -->
    <div style="border-top:1px solid #E0E0E0; background:#fff;">
        <div style="max-width:1280px; margin:0 auto; padding:0 1rem; display:flex; gap:1.5rem; height:40px; align-items:center; overflow-x:auto;">
            <a href="{{ route('pembeli.dashboard') }}" style="text-decoration:none; font-size:.8rem; font-weight:500; color:#212121; white-space:nowrap; padding:.25rem 0; border-bottom:2px solid {{ request()->routeIs('pembeli.dashboard') ? '#03AC0E' : 'transparent' }}; color:{{ request()->routeIs('pembeli.dashboard') ? '#03AC0E' : '#212121' }};">Beranda</a>
            <a href="{{ route('pembeli.orders.index') }}" style="text-decoration:none; font-size:.8rem; font-weight:500; white-space:nowrap; padding:.25rem 0; border-bottom:2px solid {{ request()->routeIs('pembeli.orders*') ? '#03AC0E' : 'transparent' }}; color:{{ request()->routeIs('pembeli.orders*') ? '#03AC0E' : '#212121' }};">Pesanan Saya</a>
            <a href="{{ route('pembeli.cart.index') }}" style="text-decoration:none; font-size:.8rem; font-weight:500; white-space:nowrap; padding:.25rem 0; border-bottom:2px solid {{ request()->routeIs('pembeli.cart*') ? '#03AC0E' : 'transparent' }}; color:{{ request()->routeIs('pembeli.cart*') ? '#03AC0E' : '#212121' }};">Keranjang</a>
            <a href="{{ route('chat.index') }}" style="text-decoration:none; font-size:.8rem; font-weight:500; white-space:nowrap; padding:.25rem 0; border-bottom:2px solid {{ request()->routeIs('chat*') ? '#03AC0E' : 'transparent' }}; color:{{ request()->routeIs('chat*') ? '#03AC0E' : '#212121' }};">Pesan</a>
        </div>
    </div>
</header>

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
            menu.style.display = menu.style.display === 'none' || !menu.style.display ? 'block' : 'none';
        });
    });
    document.addEventListener('click', function (e) {
        dropdowns.forEach(function (dropdown) {
            const menu = dropdown.querySelector('[data-dropdown-menu]');
            if (menu && !dropdown.contains(e.target)) menu.style.display = 'none';
        });
    });

    // Unread count
    @auth
    async function updateUnreadCount() {
        try {
            const res = await fetch('{{ route("chat.unread-count") }}');
            if (!res.ok) return;
            const data = await res.json();
            const badge = document.getElementById('unreadBadge');
            if (badge) {
                if (data.unread_count > 0) {
                    badge.textContent = data.unread_count;
                    badge.style.display = 'flex';
                } else {
                    badge.style.display = 'none';
                }
            }
        } catch(e) {}
    }
    updateUnreadCount();
    setInterval(updateUnreadCount, 10000);
    @endauth
});
</script>
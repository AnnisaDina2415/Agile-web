@extends('admin.layouts.app')

@section('title', 'Dashboard Admin')
@section('page-title', 'Dashboard')

@section('content')

{{-- Stat Cards --}}
<div style="display:grid; grid-template-columns:repeat(4,1fr); gap:1rem; margin-bottom:1.5rem;">

    {{-- Total Barang --}}
    <div style="background:#fff; border:1px solid #E0E0E0; border-radius:10px; padding:1.1rem 1.25rem;">
        <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:.75rem;">
            <div style="width:38px; height:38px; background:#F3FFED; border-radius:9px; display:flex; align-items:center; justify-content:center;">
                <svg style="width:18px; height:18px; color:#03AC0E;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
            </div>
            <span style="font-size:.68rem; font-weight:600; color:#03AC0E; background:#F3FFED; border:1px solid #A8D5AB; padding:.15rem .55rem; border-radius:999px;">Barang</span>
        </div>
        <p style="font-size:1.6rem; font-weight:800; color:#212121; margin:0 0 .2rem; line-height:1;">{{ $totalProducts ?? 0 }}</p>
        <p style="font-size:.75rem; color:#9E9E9E; margin:0;">Total Barang Listing</p>
    </div>

    {{-- Total Pesanan --}}
    <div style="background:#fff; border:1px solid #E0E0E0; border-radius:10px; padding:1.1rem 1.25rem;">
        <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:.75rem;">
            <div style="width:38px; height:38px; background:#FFF3E0; border-radius:9px; display:flex; align-items:center; justify-content:center;">
                <svg style="width:18px; height:18px; color:#FF6224;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
            </div>
            <span style="font-size:.68rem; font-weight:600; color:#FF6224; background:#FFF3E0; border:1px solid #FFCCBC; padding:.15rem .55rem; border-radius:999px;">Pesanan</span>
        </div>
        <p style="font-size:1.6rem; font-weight:800; color:#212121; margin:0 0 .2rem; line-height:1;">{{ $totalOrders ?? 0 }}</p>
        <p style="font-size:.75rem; color:#9E9E9E; margin:0;">Total Pesanan</p>
    </div>

    {{-- Total Pengguna --}}
    <div style="background:#fff; border:1px solid #E0E0E0; border-radius:10px; padding:1.1rem 1.25rem;">
        <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:.75rem;">
            <div style="width:38px; height:38px; background:#EEF2FF; border-radius:9px; display:flex; align-items:center; justify-content:center;">
                <svg style="width:18px; height:18px; color:#4F46E5;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"/>
                </svg>
            </div>
            <span style="font-size:.68rem; font-weight:600; color:#4F46E5; background:#EEF2FF; border:1px solid #C7D2FE; padding:.15rem .55rem; border-radius:999px;">{{ $activeUsers ?? 0 }} aktif</span>
        </div>
        <p style="font-size:1.6rem; font-weight:800; color:#212121; margin:0 0 .2rem; line-height:1;">{{ $totalUsers ?? 0 }}</p>
        <p style="font-size:.75rem; color:#9E9E9E; margin:0;">Total Pengguna</p>
    </div>

    {{-- Total Admin --}}
    <div style="background:#fff; border:1px solid #E0E0E0; border-radius:10px; padding:1.1rem 1.25rem;">
        <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:.75rem;">
            <div style="width:38px; height:38px; background:#F5F3FF; border-radius:9px; display:flex; align-items:center; justify-content:center;">
                <svg style="width:18px; height:18px; color:#7C3AED;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                </svg>
            </div>
            <span style="font-size:.68rem; font-weight:600; color:#7C3AED; background:#F5F3FF; border:1px solid #DDD6FE; padding:.15rem .55rem; border-radius:999px;">Semua aktif</span>
        </div>
        <p style="font-size:1.6rem; font-weight:800; color:#212121; margin:0 0 .2rem; line-height:1;">{{ $totalAdmins ?? 0 }}</p>
        <p style="font-size:.75rem; color:#9E9E9E; margin:0;">Total Admin</p>
    </div>
</div>

{{-- Main row --}}
<div style="display:grid; grid-template-columns:2fr 1fr; gap:1rem;">

    {{-- Pesanan Terbaru --}}
    <div style="background:#fff; border:1px solid #E0E0E0; border-radius:10px; overflow:hidden;">
        <div style="display:flex; align-items:center; justify-content:space-between; padding:1rem 1.25rem; border-bottom:1px solid #F0F0F0;">
            <h2 style="font-size:.88rem; font-weight:700; color:#212121; margin:0;">Pesanan Perlu Diproses</h2>
            <a href="{{ route('admin.orders.index') }}" style="font-size:.75rem; color:#03AC0E; font-weight:600; text-decoration:none;">Lihat semua →</a>
        </div>
        @forelse($pendingOrders ?? [] as $order)
        <div style="display:flex; align-items:center; gap:.85rem; padding:.85rem 1.25rem; border-bottom:1px solid #F5F5F5; transition:background .1s;" onmouseover="this.style.background='#FAFAFA'" onmouseout="this.style.background='transparent'">
            <div style="width:36px; height:36px; background:#F5F5F5; border-radius:8px; overflow:hidden; flex-shrink:0; display:flex; align-items:center; justify-content:center;">
                @php $img = $order->items->first()?->product?->primaryImage; @endphp
                @if($img)
                    <img src="{{ Str::startsWith($img->image_url, ['http','https']) ? $img->image_url : asset('storage/'.$img->image_url) }}" style="width:100%; height:100%; object-fit:cover;">
                @else
                    <svg style="width:16px; height:16px; color:#BDBDBD;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/></svg>
                @endif
            </div>
            <div style="flex:1; min-width:0;">
                <p style="font-size:.8rem; font-weight:600; color:#212121; margin:0; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">#{{ $order->id }} — {{ $order->user->name ?? '-' }}</p>
                <p style="font-size:.72rem; color:#9E9E9E; margin:.15rem 0 0;">{{ $order->created_at->diffForHumans() }} · {{ $order->items->count() }} item</p>
            </div>
            <div style="text-align:right; flex-shrink:0;">
                <p style="font-size:.8rem; font-weight:700; color:#03AC0E; margin:0;">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                <span style="font-size:.65rem; font-weight:600; background:#FFF3E0; color:#FF6224; border:1px solid #FFCCBC; padding:.1rem .5rem; border-radius:999px; margin-top:.2rem; display:inline-block;">{{ ucfirst($order->status) }}</span>
            </div>
        </div>
        @empty
        <div style="padding:2.5rem; text-align:center; color:#9E9E9E; font-size:.83rem;">Tidak ada pesanan menunggu 🎉</div>
        @endforelse
    </div>

    {{-- Quick Actions --}}
    <div style="background:#fff; border:1px solid #E0E0E0; border-radius:10px; overflow:hidden;">
        <div style="padding:1rem 1.25rem; border-bottom:1px solid #F0F0F0;">
            <h2 style="font-size:.88rem; font-weight:700; color:#212121; margin:0;">Menu Cepat</h2>
        </div>
        <div style="padding:.75rem;">
            @php
            $quickLinks = [
                ['href' => route('admin.users.index'),           'icon' => '👥', 'label' => 'Kelola Pengguna',      'color' => '#EEF2FF', 'text' => '#4F46E5'],
                ['href' => route('admin.seller-applications.index'), 'icon' => '🏪', 'label' => 'Pengajuan Penjual', 'color' => '#FFF3E0', 'text' => '#FF6224'],
                ['href' => route('admin.categories.index'),      'icon' => '🏷️', 'label' => 'Kelola Kategori',     'color' => '#F3FFED', 'text' => '#03AC0E'],
                ['href' => route('admin.orders.index'),          'icon' => '📦', 'label' => 'History Transaksi',   'color' => '#F5F3FF', 'text' => '#7C3AED'],
                ['href' => route('admin.admins.index'),          'icon' => '🔑', 'label' => 'Kelola Admin',        'color' => '#FEF2F2', 'text' => '#EF4444'],
            ];
            @endphp
            @foreach($quickLinks as $link)
            <a href="{{ $link['href'] }}" style="display:flex; align-items:center; gap:.75rem; padding:.65rem .85rem; text-decoration:none; border-radius:8px; margin-bottom:.3rem; transition:background .15s;"
               onmouseover="this.style.background='#F5F5F5'" onmouseout="this.style.background='transparent'">
                <span style="width:32px; height:32px; background:{{ $link['color'] }}; border-radius:8px; display:flex; align-items:center; justify-content:center; font-size:.95rem; flex-shrink:0;">{{ $link['icon'] }}</span>
                <span style="font-size:.82rem; font-weight:500; color:#212121;">{{ $link['label'] }}</span>
                <svg style="width:12px; height:12px; color:#BDBDBD; margin-left:auto;" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/></svg>
            </a>
            @endforeach
        </div>
    </div>
</div>

@endsection
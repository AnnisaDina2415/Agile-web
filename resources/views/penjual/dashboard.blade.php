@extends('layouts.penjual-new')

@section('title', 'Dashboard Penjual - ReGoods')

@section('content')

{{-- Header --}}
<div style="margin-bottom:1.5rem;">
    <h1 style="font-size:1.2rem; font-weight:700; color:#212121; margin:0 0 .25rem;">Selamat datang, {{ Auth::user()->name ?? 'Penjual' }}! 👋</h1>
    <p style="font-size:.82rem; color:#9E9E9E; margin:0;">{{ now()->isoFormat('dddd, D MMMM Y') }}</p>
</div>

{{-- KPI Cards --}}
<div style="display:grid; grid-template-columns:repeat(4,1fr); gap:1rem; margin-bottom:1.5rem;">

    {{-- Total Produk --}}
    <div style="background:#fff; border:1px solid #E0E0E0; border-radius:10px; padding:1.25rem;">
        <div style="display:flex; align-items:flex-start; justify-content:space-between;">
            <div>
                <p style="font-size:.78rem; color:#9E9E9E; margin:0 0 .4rem; font-weight:500;">Total Produk</p>
                <p style="font-size:1.8rem; font-weight:800; color:#212121; margin:0; line-height:1;">{{ $totalProducts ?? 0 }}</p>
            </div>
            <div style="width:40px; height:40px; background:#F3FFED; border-radius:10px; display:flex; align-items:center; justify-content:center;">
                <svg style="width:20px; height:20px; color:#03AC0E;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"/>
                </svg>
            </div>
        </div>
        <p style="font-size:.72rem; color:#03AC0E; margin:.5rem 0 0; font-weight:500;">Produk aktif terdaftar</p>
    </div>

    {{-- Total Penjualan --}}
    <div style="background:#fff; border:1px solid #E0E0E0; border-radius:10px; padding:1.25rem;">
        <div style="display:flex; align-items:flex-start; justify-content:space-between;">
            <div>
                <p style="font-size:.78rem; color:#9E9E9E; margin:0 0 .4rem; font-weight:500;">Total Penjualan</p>
                <p style="font-size:1.8rem; font-weight:800; color:#03AC0E; margin:0; line-height:1;">{{ $totalSales ?? 0 }}</p>
            </div>
            <div style="width:40px; height:40px; background:#FFF3E0; border-radius:10px; display:flex; align-items:center; justify-content:center;">
                <svg style="width:20px; height:20px; color:#FF6224;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M13 7h8m0 0v8m0-8l-8 8-4-4-6 6"/>
                </svg>
            </div>
        </div>
        <p style="font-size:.72rem; color:#FF6224; margin:.5rem 0 0; font-weight:500;">Total transaksi selesai</p>
    </div>

    {{-- Rating --}}
    <div style="background:#fff; border:1px solid #E0E0E0; border-radius:10px; padding:1.25rem;">
        <div style="display:flex; align-items:flex-start; justify-content:space-between;">
            <div>
                <p style="font-size:.78rem; color:#9E9E9E; margin:0 0 .4rem; font-weight:500;">Rating Toko</p>
                <div style="display:flex; align-items:center; gap:.35rem;">
                    <p style="font-size:1.8rem; font-weight:800; color:#212121; margin:0; line-height:1;">{{ $storeRating ?? '4.5' }}</p>
                    <svg style="width:18px; height:18px; color:#FFA500;" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2l-2.81 6.63L2 9.24l5.46 4.73L5.82 21z"/>
                    </svg>
                </div>
            </div>
            <div style="width:40px; height:40px; background:#FFF8E1; border-radius:10px; display:flex; align-items:center; justify-content:center;">
                <svg style="width:20px; height:20px; color:#FFA500;" fill="currentColor" viewBox="0 0 24 24">
                    <path d="M12 17.27L18.18 21l-1.64-7.03L22 9.24l-7.19-.61L12 2l-2.81 6.63L2 9.24l5.46 4.73L5.82 21z"/>
                </svg>
            </div>
        </div>
        <p style="font-size:.72rem; color:#9E9E9E; margin:.5rem 0 0; font-weight:500;">Dari ulasan pembeli</p>
    </div>

    {{-- Pesanan --}}
    <div style="background:#fff; border:1px solid #E0E0E0; border-radius:10px; padding:1.25rem;">
        <div style="display:flex; align-items:flex-start; justify-content:space-between;">
            <div>
                <p style="font-size:.78rem; color:#9E9E9E; margin:0 0 .4rem; font-weight:500;">Pesanan Menunggu</p>
                <p style="font-size:1.8rem; font-weight:800; color:#FF6224; margin:0; line-height:1;">{{ $pendingOrders ?? 0 }}</p>
            </div>
            <div style="width:40px; height:40px; background:#FEF3F2; border-radius:10px; display:flex; align-items:center; justify-content:center;">
                <svg style="width:20px; height:20px; color:#FF6224;" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>
        <p style="font-size:.72rem; color:#FF6224; margin:.5rem 0 0; font-weight:500;">Perlu segera diproses</p>
    </div>
</div>

{{-- Products Table --}}
<div style="background:#fff; border:1px solid #E0E0E0; border-radius:10px; overflow:hidden;">
    <div style="display:flex; align-items:center; justify-content:space-between; padding:1.1rem 1.5rem; border-bottom:1px solid #F0F0F0;">
        <h2 style="font-size:.95rem; font-weight:700; color:#212121; margin:0;">Kelola Produk Saya</h2>
        <a href="{{ route('penjual.produk.create') }}" style="background:#03AC0E; color:#fff; text-decoration:none; border-radius:8px; padding:.5rem 1rem; font-size:.8rem; font-weight:600; transition:background .15s; display:inline-flex; align-items:center; gap:.35rem;"
            onmouseover="this.style.background='#028A0B'" onmouseout="this.style.background='#03AC0E'">
            <span>+</span> Tambah Produk
        </a>
    </div>

    @if(session('success'))
        <div style="margin:1rem 1.5rem; background:#F3FFED; border:1px solid #A8D5AB; color:#1B5E20; padding:.7rem 1rem; border-radius:8px; font-size:.83rem;">
            ✓ {{ session('success') }}
        </div>
    @endif

    @if(isset($products) && $products->count())
        <div style="overflow-x:auto;">
            <table style="width:100%; border-collapse:collapse; font-size:.83rem;">
                <thead>
                    <tr style="background:#FAFAFA; border-bottom:1px solid #E0E0E0;">
                        <th style="text-align:left; padding:.75rem 1.25rem; font-weight:600; color:#616161; font-size:.75rem; text-transform:uppercase; letter-spacing:.5px;">Nama Produk</th>
                        <th style="text-align:left; padding:.75rem 1rem; font-weight:600; color:#616161; font-size:.75rem; text-transform:uppercase; letter-spacing:.5px;">Harga</th>
                        <th style="text-align:left; padding:.75rem 1rem; font-weight:600; color:#616161; font-size:.75rem; text-transform:uppercase; letter-spacing:.5px;">Stok</th>
                        <th style="text-align:left; padding:.75rem 1rem; font-weight:600; color:#616161; font-size:.75rem; text-transform:uppercase; letter-spacing:.5px;">Status</th>
                        <th style="text-align:left; padding:.75rem 1rem; font-weight:600; color:#616161; font-size:.75rem; text-transform:uppercase; letter-spacing:.5px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr style="border-bottom:1px solid #F5F5F5; transition:background .1s;" onmouseover="this.style.background='#FAFAFA'" onmouseout="this.style.background='transparent'">
                        <td style="padding:.85rem 1.25rem; color:#212121; font-weight:500;">{{ $product->name }}</td>
                        <td style="padding:.85rem 1rem; color:#03AC0E; font-weight:600;">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                        <td style="padding:.85rem 1rem;">
                            <span style="padding:.2rem .65rem; border-radius:999px; font-size:.72rem; font-weight:600; background:{{ $product->stock > 0 ? '#F3FFED' : '#FEF2F2' }}; color:{{ $product->stock > 0 ? '#03AC0E' : '#EF4444' }}; border:1px solid {{ $product->stock > 0 ? '#A8D5AB' : '#FECACA' }};">
                                {{ $product->stock }}
                            </span>
                        </td>
                        <td style="padding:.85rem 1rem;">
                            <div style="display:flex; gap:.4rem; flex-wrap:wrap;">
                                <span style="padding:.2rem .65rem; border-radius:999px; font-size:.72rem; font-weight:600; background:#EEF2FF; color:#4F46E5;">{{ ucfirst($product->status) }}</span>
                                <span style="padding:.2rem .65rem; border-radius:999px; font-size:.72rem; font-weight:600; background:{{ $product->is_active ? '#F3FFED' : '#F5F5F5' }}; color:{{ $product->is_active ? '#03AC0E' : '#9E9E9E' }}; border:1px solid {{ $product->is_active ? '#A8D5AB' : '#E0E0E0' }};">
                                    {{ $product->is_active ? 'Aktif' : 'Non-Aktif' }}
                                </span>
                            </div>
                        </td>
                        <td style="padding:.85rem 1rem;">
                            <div style="display:flex; gap:.4rem;">
                                <a href="{{ route('penjual.produk.edit', $product) }}" style="padding:.3rem .75rem; font-size:.75rem; font-weight:600; background:#FFF8E1; color:#F59E0B; border-radius:6px; text-decoration:none; border:1px solid #FDE68A; transition:background .15s;"
                                    onmouseover="this.style.background='#FEF3C7'" onmouseout="this.style.background='#FFF8E1'">Edit</a>
                                <form action="{{ route('penjual.produk.toggle-active', $product) }}" method="post" style="display:inline;">
                                    @csrf @method('PATCH')
                                    <button type="submit" onclick="return confirm('{{ $product->is_active ? 'Non-aktifkan' : 'Aktifkan' }} produk ini?')"
                                        style="padding:.3rem .75rem; font-size:.75rem; font-weight:600; border-radius:6px; cursor:pointer; border:1px solid; transition:background .15s; font-family:inherit;
                                        {{ $product->is_active ? 'background:#FEF2F2; color:#EF4444; border-color:#FECACA;' : 'background:#F3FFED; color:#03AC0E; border-color:#A8D5AB;' }}">
                                        {{ $product->is_active ? 'Non-Aktif' : 'Aktifkan' }}
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @if(method_exists($products, 'links'))
            <div style="padding:1rem 1.5rem; border-top:1px solid #F0F0F0;">{{ $products->links() }}</div>
        @endif
    @else
        <div style="text-align:center; padding:3rem; color:#9E9E9E;">
            <p style="font-size:2rem; margin:0 0 .75rem;">📦</p>
            <p style="font-size:.9rem; font-weight:600; color:#424242; margin:0 0 .4rem;">Belum ada produk</p>
            <p style="font-size:.8rem; margin:0 0 1.25rem;">Mulai berjualan dengan menambahkan produk pertama Anda</p>
            <a href="{{ route('penjual.produk.create') }}" style="background:#03AC0E; color:#fff; text-decoration:none; border-radius:8px; padding:.6rem 1.5rem; font-size:.85rem; font-weight:600; display:inline-block;">Buat Produk Pertama</a>
        </div>
    @endif
</div>

@endsection

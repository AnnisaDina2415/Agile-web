@extends('layouts.pembeli')

@section('title', 'Beranda - ReGoods')

@section('content')

{{-- Hero Banner --}}
<div style="background:linear-gradient(135deg,#03AC0E 0%,#028A0B 60%,#025F08 100%); border-radius:12px; padding:2rem 2.5rem; margin-bottom:1.5rem; color:#fff; position:relative; overflow:hidden;">
    <div style="position:absolute; right:-40px; top:-40px; width:220px; height:220px; background:rgba(255,255,255,.07); border-radius:50%;"></div>
    <div style="position:absolute; right:60px; bottom:-60px; width:160px; height:160px; background:rgba(255,255,255,.05); border-radius:50%;"></div>
    <div style="position:relative; z-index:1; max-width:600px;">
        <span style="display:inline-block; background:rgba(255,255,255,.18); border-radius:999px; padding:.25rem .85rem; font-size:.72rem; font-weight:700; letter-spacing:.5px; text-transform:uppercase; margin-bottom:.75rem;">♻️ Sustainable & Second-Hand</span>
        <h1 style="font-size:1.8rem; font-weight:800; line-height:1.25; margin:0 0 .6rem;">Temukan Barang Impian,<br>Dukung Bumi Lebih Hijau!</h1>
        <p style="font-size:.87rem; opacity:.88; line-height:1.6; margin:0;">Beli barang bekas berkualitas dari penjual terpercaya. Hemat biaya, kurangi limbah!</p>
    </div>
</div>

{{-- Search & Filter --}}
<div style="background:#fff; border:1px solid #E0E0E0; border-radius:10px; padding:1.25rem 1.5rem; margin-bottom:1.5rem;">
    <form action="{{ route('pembeli.dashboard') }}" method="GET">
        <div style="display:flex; gap:.75rem; margin-bottom:1rem;">
            <div style="position:relative; flex:1;">
                <svg style="position:absolute; left:.8rem; top:50%; transform:translateY(-50%); width:16px; height:16px; color:#9E9E9E;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                </svg>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama barang atau kategori..."
                    style="width:100%; border:1.5px solid #E0E0E0; border-radius:8px; padding:.65rem .9rem .65rem 2.4rem; font-size:.88rem; outline:none; font-family:inherit; color:#212121; transition:border-color .15s;"
                    onfocus="this.style.borderColor='#03AC0E'" onblur="this.style.borderColor='#E0E0E0'">
            </div>
            <button type="submit" style="background:#03AC0E; color:#fff; border:none; border-radius:8px; padding:.65rem 1.5rem; font-size:.88rem; font-weight:600; cursor:pointer; font-family:inherit; white-space:nowrap; transition:background .15s;"
                onmouseover="this.style.background='#028A0B'" onmouseout="this.style.background='#03AC0E'">Cari</button>
            <a href="{{ route('pembeli.dashboard') }}" style="background:#F5F5F5; color:#424242; border:1px solid #E0E0E0; border-radius:8px; padding:.65rem 1rem; font-size:.88rem; font-weight:500; text-decoration:none; white-space:nowrap; display:flex; align-items:center;">Reset</a>
        </div>

        <div style="display:grid; grid-template-columns:repeat(4,1fr); gap:.75rem; padding-top:.9rem; border-top:1px solid #F0F0F0;">
            <div>
                <label style="display:block; font-size:.73rem; font-weight:600; color:#9E9E9E; text-transform:uppercase; letter-spacing:.5px; margin-bottom:.35rem;">Kategori</label>
                <select name="category" style="width:100%; border:1.5px solid #E0E0E0; border-radius:8px; padding:.55rem .75rem; font-size:.83rem; font-family:inherit; color:#212121; outline:none; background:#fff; cursor:pointer;"
                    onfocus="this.style.borderColor='#03AC0E'" onblur="this.style.borderColor='#E0E0E0'">
                    <option value="">Semua Kategori</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label style="display:block; font-size:.73rem; font-weight:600; color:#9E9E9E; text-transform:uppercase; letter-spacing:.5px; margin-bottom:.35rem;">Kondisi</label>
                <select name="condition" style="width:100%; border:1.5px solid #E0E0E0; border-radius:8px; padding:.55rem .75rem; font-size:.83rem; font-family:inherit; color:#212121; outline:none; background:#fff; cursor:pointer;"
                    onfocus="this.style.borderColor='#03AC0E'" onblur="this.style.borderColor='#E0E0E0'">
                    <option value="">Semua Kondisi</option>
                    <option value="Sangat Baik" {{ request('condition') == 'Sangat Baik' ? 'selected' : '' }}>Sangat Baik</option>
                    <option value="Baik" {{ request('condition') == 'Baik' ? 'selected' : '' }}>Baik</option>
                    <option value="Cukup" {{ request('condition') == 'Cukup' ? 'selected' : '' }}>Cukup</option>
                    <option value="Rusak Ringan" {{ request('condition') == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
                </select>
            </div>
            <div>
                <label style="display:block; font-size:.73rem; font-weight:600; color:#9E9E9E; text-transform:uppercase; letter-spacing:.5px; margin-bottom:.35rem;">Harga Maks (Rp)</label>
                <input type="number" name="max_price" value="{{ request('max_price') }}" placeholder="Contoh: 500000"
                    style="width:100%; border:1.5px solid #E0E0E0; border-radius:8px; padding:.55rem .75rem; font-size:.83rem; font-family:inherit; color:#212121; outline:none; transition:border-color .15s;"
                    onfocus="this.style.borderColor='#03AC0E'" onblur="this.style.borderColor='#E0E0E0'">
            </div>
            <div>
                <label style="display:block; font-size:.73rem; font-weight:600; color:#9E9E9E; text-transform:uppercase; letter-spacing:.5px; margin-bottom:.35rem;">Urutkan</label>
                <select name="sort" style="width:100%; border:1.5px solid #E0E0E0; border-radius:8px; padding:.55rem .75rem; font-size:.83rem; font-family:inherit; color:#212121; outline:none; background:#fff; cursor:pointer;"
                    onfocus="this.style.borderColor='#03AC0E'" onblur="this.style.borderColor='#E0E0E0'">
                    <option value="">Terbaru</option>
                    <option value="price_asc" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Harga Termurah</option>
                    <option value="price_desc" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Harga Termahal</option>
                </select>
            </div>
        </div>
    </form>
</div>

{{-- Products Section --}}
<div>
    <div style="display:flex; align-items:center; justify-content:space-between; margin-bottom:1rem;">
        <h2 style="font-size:1.05rem; font-weight:700; color:#212121; margin:0;">Katalog Barang</h2>
        <span style="font-size:.8rem; color:#9E9E9E;">{{ $products->count() }} barang ditemukan</span>
    </div>

    @if($products->count() > 0)
        <div style="display:grid; grid-template-columns:repeat(auto-fill,minmax(190px,1fr)); gap:1rem;">
            @foreach ($products as $product)
            @php $image = $product->primaryImage; @endphp
            <a href="{{ route('pembeli.products.show', $product->id) }}" style="text-decoration:none; display:block;">
                <div style="background:#fff; border:1px solid #E0E0E0; border-radius:10px; overflow:hidden; transition:box-shadow .15s, transform .15s; cursor:pointer;"
                    onmouseover="this.style.boxShadow='0 4px 16px rgba(0,0,0,.1)'; this.style.transform='translateY(-2px)'"
                    onmouseout="this.style.boxShadow='none'; this.style.transform='translateY(0)'">
                    {{-- Image --}}
                    <div style="aspect-ratio:1; background:#F5F5F5; overflow:hidden; position:relative;">
                        <img src="{{ $image ? (Str::startsWith($image->image_url, ['http://', 'https://']) ? $image->image_url : asset('storage/' . $image->image_url)) : asset('images/no-image.png') }}"
                            style="width:100%; height:100%; object-fit:cover; transition:transform .3s;"
                            alt="{{ $product->name }}"
                            onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                        @php
                            $conditionColors = [
                                'Sangat Baik' => '#03AC0E',
                                'Baik' => '#008080',
                                'Cukup' => '#FFA500',
                                'Rusak Ringan' => '#D8000C',
                            ];
                            $badgeColor = $conditionColors[$product->condition] ?? '#757575';
                        @endphp
                        <span style="position:absolute; top:8px; left:8px; font-size:.65rem; font-weight:700; padding:.18rem .55rem; border-radius:4px; background:{{ $badgeColor }}; color:#fff; text-transform:uppercase;">
                            {{ $product->condition }}
                        </span>
                    </div>
                    {{-- Info --}}
                    <div style="padding:.75rem .85rem;">
                        <p style="font-size:.67rem; color:#9E9E9E; margin:0 0 .2rem; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">{{ $product->user->name ?? 'Anonim' }}</p>
                        <p style="font-size:.85rem; font-weight:600; color:#212121; margin:0 0 .5rem; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden; line-height:1.3;">{{ $product->name }}</p>
                        <p style="font-size:1rem; font-weight:700; color:#03AC0E; margin:0;">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    </div>
                </div>
            </a>
            @endforeach
        </div>
    @else
        <div style="background:#fff; border:1px solid #E0E0E0; border-radius:10px; padding:3rem; text-align:center;">
            <p style="font-size:2.5rem; margin:0 0 .75rem;">🔍</p>
            <h3 style="font-size:1rem; font-weight:700; color:#212121; margin:0 0 .4rem;">Barang Tidak Ditemukan</h3>
            <p style="font-size:.83rem; color:#9E9E9E; margin:0 0 1.25rem;">Coba ubah kata kunci atau reset filter</p>
            <a href="{{ route('pembeli.dashboard') }}" style="background:#03AC0E; color:#fff; text-decoration:none; border-radius:8px; padding:.6rem 1.5rem; font-size:.85rem; font-weight:600; display:inline-block;">Lihat Semua Barang</a>
        </div>
    @endif
</div>

@endsection
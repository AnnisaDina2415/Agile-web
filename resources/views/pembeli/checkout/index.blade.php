@extends('layouts.pembeli')

@section('title', 'Checkout - ReGoods')

@section('content')

{{-- Breadcrumb --}}
<div style="display:flex; align-items:center; gap:.5rem; font-size:.8rem; color:#9E9E9E; margin-bottom:1.25rem;">
    <a href="{{ route('pembeli.dashboard') }}" style="color:#9E9E9E; text-decoration:none;" onmouseover="this.style.color='#03AC0E'" onmouseout="this.style.color='#9E9E9E'">Beranda</a>
    <span>/</span>
    <a href="{{ route('pembeli.cart.index') }}" style="color:#9E9E9E; text-decoration:none;" onmouseover="this.style.color='#03AC0E'" onmouseout="this.style.color='#9E9E9E'">Keranjang</a>
    <span>/</span>
    <span style="color:#212121; font-weight:500;">Checkout</span>
</div>

@if(session('error'))
    <div style="background:#FEF2F2; border:1px solid #FECACA; color:#B91C1C; padding:.85rem 1rem; border-radius:10px; font-size:.85rem; margin-bottom:1rem; display:flex; align-items:center; gap:.6rem;">
        <span>⚠️</span> {{ session('error') }}
    </div>
@endif

<form action="{{ route('pembeli.checkout.store') }}" method="POST" id="checkoutForm">
    @csrf
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 items-start">

        {{-- ===== KIRI: Form Pengiriman + Barang ===== --}}
        <div class="lg:col-span-2 flex flex-col gap-4">

            {{-- Form Informasi Penerima --}}
            <div style="background:#fff; border:1px solid #E0E0E0; border-radius:12px; overflow:hidden;">
                <div style="display:flex; align-items:center; gap:.6rem; padding:1rem 1.25rem; border-bottom:1px solid #F0F0F0; background:#FAFAFA;">
                    <span style="width:28px; height:28px; background:#03AC0E; border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:.8rem; color:#fff; font-weight:700; flex-shrink:0;">1</span>
                    <h2 style="font-size:.95rem; font-weight:700; color:#212121; margin:0;">Informasi Penerima & Alamat Pengiriman</h2>
                </div>

                <div style="padding:1.25rem;">

                {{-- Grid 2 kolom --}}
                <div style="display:grid; grid-template-columns:1fr 1fr; gap:1rem; margin-bottom:1rem;">
                    {{-- Nama Penerima --}}
                    <div>
                        <label for="recipient_name" style="display:block; font-size:.73rem; font-weight:700; color:#424242; text-transform:uppercase; letter-spacing:.5px; margin-bottom:.4rem;">Nama Penerima <span style="color:#EF4444;">*</span></label>
                        <input type="text" name="recipient_name" id="recipient_name" value="{{ old('recipient_name', $user->name) }}" required
                            style="width:100%; border:1.5px solid #E0E0E0; border-radius:8px; padding:.7rem .9rem; font-size:.88rem; color:#212121; font-family:inherit; outline:none; transition:border-color .15s; box-sizing:border-box;"
                            onfocus="this.style.borderColor='#03AC0E'; this.style.boxShadow='0 0 0 3px rgba(3,172,14,.08)'"
                            onblur="this.style.borderColor='#E0E0E0'; this.style.boxShadow='none'">
                        @error('recipient_name')
                            <p style="color:#EF4444; font-size:.73rem; margin:.3rem 0 0;">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div>
                        <label for="recipient_email" style="display:block; font-size:.73rem; font-weight:700; color:#424242; text-transform:uppercase; letter-spacing:.5px; margin-bottom:.4rem;">Email <span style="color:#EF4444;">*</span></label>
                        <input type="email" name="recipient_email" id="recipient_email" value="{{ old('recipient_email', $user->email) }}" required
                            style="width:100%; border:1.5px solid #E0E0E0; border-radius:8px; padding:.7rem .9rem; font-size:.88rem; color:#212121; font-family:inherit; outline:none; transition:border-color .15s; box-sizing:border-box;"
                            onfocus="this.style.borderColor='#03AC0E'; this.style.boxShadow='0 0 0 3px rgba(3,172,14,.08)'"
                            onblur="this.style.borderColor='#E0E0E0'; this.style.boxShadow='none'">
                        @error('recipient_email')
                            <p style="color:#EF4444; font-size:.73rem; margin:.3rem 0 0;">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                {{-- Nomor Telepon --}}
                <div style="margin-bottom:1rem;">
                    <label for="phone" style="display:block; font-size:.73rem; font-weight:700; color:#424242; text-transform:uppercase; letter-spacing:.5px; margin-bottom:.4rem;">
                        Nomor WhatsApp / Telepon <span style="color:#EF4444;">*</span>
                    </label>
                    <input type="text" name="phone" id="phone"
                        value="{{ old('phone', $user->phone) }}"
                        placeholder="Contoh: 0812-3456-7890"
                        required
                        style="width:100%; border:1.5px solid #E0E0E0; border-radius:8px; padding:.7rem .9rem; font-size:.88rem; color:#212121; font-family:inherit; outline:none; transition:border-color .15s; box-sizing:border-box;"
                        onfocus="this.style.borderColor='#03AC0E'; this.style.boxShadow='0 0 0 3px rgba(3,172,14,.08)'"
                        onblur="this.style.borderColor='#E0E0E0'; this.style.boxShadow='none'">
                    @error('phone')
                        <p style="color:#EF4444; font-size:.73rem; margin:.3rem 0 0;">{{ $message }}</p>
                    @enderror
                </div>

                {{-- ===== ALAMAT LENGKAP ===== --}}
                <div style="margin-bottom:1.25rem;">
                    <label for="address" style="display:block; font-size:.73rem; font-weight:700; color:#424242; text-transform:uppercase; letter-spacing:.5px; margin-bottom:.4rem;">
                        📍 Alamat Lengkap Pengiriman <span style="color:#EF4444;">*</span>
                    </label>
                    <textarea name="address" id="address" rows="4"
                        placeholder="Contoh: Jl. Merdeka No. 12, RT 03/RW 05, Kel. Sukamaju, Kec. Ciputat, Tangerang Selatan, Banten 15411"
                        required
                        style="width:100%; border:1.5px solid #E0E0E0; border-radius:8px; padding:.7rem .9rem; font-size:.88rem; color:#212121; font-family:inherit; outline:none; resize:vertical; transition:border-color .15s; box-sizing:border-box; line-height:1.5;"
                        onfocus="this.style.borderColor='#03AC0E'; this.style.boxShadow='0 0 0 3px rgba(3,172,14,.08)'"
                        onblur="this.style.borderColor='#E0E0E0'; this.style.boxShadow='none'">{{ old('address', $user->address) }}</textarea>
                    <p style="font-size:.72rem; color:#9E9E9E; margin:.3rem 0 0;">Tulis lengkap: nama jalan, nomor, RT/RW, kelurahan, kecamatan, kota, kode pos</p>
                    @error('address')
                        <p style="color:#EF4444; font-size:.73rem; margin:.3rem 0 0;">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Catatan Tambahan --}}
                <div>
                    <label for="notes" style="display:block; font-size:.73rem; font-weight:700; color:#424242; text-transform:uppercase; letter-spacing:.5px; margin-bottom:.4rem;">
                        Catatan untuk Penjual (Opsional)
                    </label>
                    <input type="text" name="notes" id="notes"
                        value="{{ old('notes') }}"
                        placeholder="Contoh: taruh di depan pintu, titip tetangga, dsb."
                        style="width:100%; border:1.5px solid #E0E0E0; border-radius:8px; padding:.65rem .9rem; font-size:.88rem; color:#212121; font-family:inherit; outline:none; transition:border-color .15s; box-sizing:border-box;"
                        onfocus="this.style.borderColor='#03AC0E'; this.style.boxShadow='0 0 0 3px rgba(3,172,14,.08)'"
                        onblur="this.style.borderColor='#E0E0E0'; this.style.boxShadow='none'">
                </div>
                </div>
        </div>

        {{-- Barang yang Dipesan --}}
        <div style="background:#fff; border:1px solid #E0E0E0; border-radius:12px; overflow:hidden;">
            <div style="display:flex; align-items:center; gap:.6rem; padding:1rem 1.25rem; border-bottom:1px solid #F0F0F0; background:#FAFAFA;">
                <span style="width:28px; height:28px; background:#03AC0E; border-radius:50%; display:flex; align-items:center; justify-content:center; font-size:.8rem; color:#fff; font-weight:700; flex-shrink:0;">2</span>
                <h2 style="font-size:.95rem; font-weight:700; color:#212121; margin:0;">Barang yang Dipesan</h2>
            </div>

            <div style="padding:.5rem 1.25rem;">
                @foreach($items as $item)
                @php $img = $item->product->primaryImage; @endphp
                <div style="display:flex; align-items:center; gap:.85rem; padding:.85rem 0; border-bottom:1px solid #F5F5F5;">
                    <div style="width:56px; height:56px; border-radius:8px; overflow:hidden; background:#F5F5F5; flex-shrink:0;">
                        <img src="{{ $img ? (Str::startsWith($img->image_url, ['http://', 'https://']) ? $img->image_url : asset('storage/'.$img->image_url)) : asset('images/no-image.png') }}"
                            style="width:100%; height:100%; object-fit:cover;" alt="{{ $item->product->name }}">
                    </div>
                    <div style="flex:1; min-width:0;">
                        <p style="font-size:.88rem; font-weight:600; color:#212121; margin:0 0 .2rem; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">{{ $item->product->name }}</p>
                        <p style="font-size:.75rem; color:#9E9E9E; margin:0;">Penjual: {{ $item->product->user->name ?? '-' }}</p>
                        <p style="font-size:.78rem; color:#616161; margin:.2rem 0 0;">{{ $item->quantity }} x Rp {{ number_format($item->product->price, 0, ',', '.') }}</p>
                    </div>
                    <div style="text-align:right; flex-shrink:0;">
                        <p style="font-size:.9rem; font-weight:700; color:#03AC0E; margin:0;">Rp {{ number_format($item->getSubtotal(), 0, ',', '.') }}</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

        {{-- ===== KANAN: Ringkasan Pembayaran ===== --}}
        <div class="lg:col-span-1 sticky top-20">
        <div style="background:#fff; border:1px solid #E0E0E0; border-radius:12px; overflow:hidden;">
            <div style="padding:1rem 1.25rem; border-bottom:1px solid #F0F0F0; background:#FAFAFA;">
                <h2 style="font-size:.95rem; font-weight:700; color:#212121; margin:0;">Ringkasan Pembayaran</h2>
            </div>

            <div style="padding:1.1rem 1.25rem;">
                {{-- Items total --}}
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:.65rem;">
                    <span style="font-size:.83rem; color:#616161;">Total Harga ({{ $items->sum('quantity') }} barang)</span>
                    <span style="font-size:.83rem; font-weight:500; color:#212121;">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                </div>

                {{-- Shipping --}}
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:.65rem;">
                    <span style="font-size:.83rem; color:#616161;">Biaya Pengiriman</span>
                    <span style="font-size:.83rem; font-weight:500; color:#212121;">Rp {{ number_format($shipping, 0, ',', '.') }}</span>
                </div>

                {{-- Divider --}}
                <div style="border-top:1px dashed #E0E0E0; margin:.85rem 0;"></div>

                {{-- Total --}}
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:1.25rem;">
                    <span style="font-size:.95rem; font-weight:700; color:#212121;">Total Bayar</span>
                    <span style="font-size:1.2rem; font-weight:800; color:#03AC0E;">Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>

                {{-- ===== TOMBOL BAYAR SEKARANG ===== --}}
                <button type="submit" form="checkoutForm"
                    style="width:100%; background:#03AC0E; color:#fff; border:none; border-radius:10px; padding:.9rem; font-size:1rem; font-weight:700; cursor:pointer; font-family:inherit; transition:background .15s; margin-bottom:.6rem;"
                    onmouseover="this.style.background='#028A0F'" onmouseout="this.style.background='#03AC0E'">
                    🛒 Buat Pesanan & Bayar
                </button>

                <a href="{{ route('pembeli.cart.index') }}"
                    style="display:block; text-align:center; width:100%; border:1.5px solid #E0E0E0; border-radius:10px; padding:.7rem; font-size:.85rem; font-weight:600; color:#616161; text-decoration:none; transition:all .15s; box-sizing:border-box;"
                    onmouseover="this.style.borderColor='#9E9E9E'; this.style.background='#F5F5F5'"
                    onmouseout="this.style.borderColor='#E0E0E0'; this.style.background='transparent'">
                    ← Kembali ke Keranjang
                </a>
            </div>

            {{-- Security badge --}}
            <div style="padding:.85rem 1.25rem; background:#F9F9F9; border-top:1px solid #F0F0F0; display:flex; align-items:center; justify-content:center; gap:.4rem;">
                <span style="font-size:.8rem;">🛡️</span>
                <span style="font-size:.73rem; color:#9E9E9E; font-weight:500;">Pembayaran Aman & Terlindungi Midtrans</span>
            </div>
        </div>
        </div>
    </div>
</form>

@endsection

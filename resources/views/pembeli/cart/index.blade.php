@extends('layouts.pembeli')

@section('title', 'Keranjang Belanja - ReGoods')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Breadcrumb -->
    <div class="mb-6 text-sm text-gray-600">
        <a href="{{ route('pembeli.dashboard') }}" class="hover:text-green-600">Beranda</a>
        <span class="mx-2">/</span>
        <span class="text-gray-800 font-medium">Keranjang Belanja</span>
    </div>

    <!-- Success Alert -->
    @if (session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6" role="alert">
            <p class="font-bold">Berhasil!</p>
            <p class="text-sm">{{ session('success') }}</p>
        </div>
    @endif

    @if ($items->count() > 0)
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Items Column -->
            <div class="lg:col-span-2">
                <div class="glassmorphism rounded-3xl shadow p-6 mb-6">
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-2xl font-bold text-gray-800">Keranjang Belanja</h1>
                        <span class="bg-emerald-100 text-emerald-850 px-3 py-1 rounded-full text-sm font-semibold border border-emerald-250">
                            {{ $items->count() }} produk
                        </span>
                    </div>

                    <div class="space-y-4">
                        @foreach ($items as $item)
                            <div class="border-b border-emerald-250/75 pb-4 last:border-0">
                                <div class="flex gap-4">
                                    <!-- Product Image -->
                                    <div class="w-24 h-24 bg-gray-200 rounded-lg overflow-hidden flex-shrink-0">
                                        @php
                                            $image = $item->product->primaryImage;
                                        @endphp
                                        <img 
                                            src="{{ $image ? (Str::startsWith($image->image_url, ['http://', 'https://']) ? $image->image_url : asset('storage/' . $image->image_url)) : asset('images/no-image.png') }}" 
                                            alt="{{ $item->product->name }}"
                                            class="w-full h-full object-cover"
                                        >
                                    </div>

                                    <!-- Product Info -->
                                    <div class="flex-1">
                                        <a href="{{ route('pembeli.products.show', $item->product->id) }}" class="hover:text-emerald-700">
                                            <h3 class="font-bold text-gray-800 hover:underline">
                                                {{ $item->product->name }}
                                            </h3>
                                        </a>

                                        <p class="text-sm text-gray-650 mt-1">
                                            Penjual: 
                                            <a href="{{ route('pembeli.sellers.show', $item->product->user->id) }}" class="text-emerald-600 hover:underline font-semibold">
                                                {{ $item->product->user->name }}
                                            </a>
                                        </p>

                                        <p class="text-green-600 font-bold mt-2">
                                            Rp {{ number_format($item->product->price, 0, ',', '.') }}
                                        </p>

                                        <!-- Quantity & Actions -->
                                        <div class="flex items-center gap-3 mt-3">
                                            <form action="{{ route('pembeli.cart.update', $item->id) }}" method="POST" class="flex items-center gap-2">
                                                @csrf
                                                <button type="button" onclick="decreaseQty(this, {{ $item->id }})" class="bg-slate-200 hover:bg-slate-300 px-2 py-1 rounded">
                                                    −
                                                </button>
                                                <input 
                                                    type="number" 
                                                    name="quantity" 
                                                    value="{{ $item->quantity }}" 
                                                    min="1" 
                                                    max="{{ $item->product->stock }}"
                                                    class="w-12 text-center border border-slate-300 rounded px-2"
                                                    onchange="this.form.submit()"
                                                >
                                                <button type="button" onclick="increaseQty(this, {{ $item->id }}, {{ $item->product->stock }})" class="bg-slate-200 hover:bg-slate-300 px-2 py-1 rounded">
                                                    +
                                                </button>
                                            </form>

                                            <form action="{{ route('pembeli.cart.remove', $item->id) }}" method="POST" class="ml-auto">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-700 font-semibold text-sm">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </div>

                                    <!-- Subtotal -->
                                    <div class="text-right">
                                        <p class="text-gray-650 text-sm mb-2">Subtotal</p>
                                        <p class="font-bold text-lg text-emerald-700">
                                            Rp {{ number_format($item->getSubtotal(), 0, ',', '.') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Clear Cart -->
                    <div class="mt-6 pt-6 border-t border-emerald-250/70">
                        <form action="{{ route('pembeli.cart.clear') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-red-650 hover:text-red-750 text-sm font-semibold">
                                Kosongkan Keranjang
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Summary Column -->
            <div>
                <div class="glassmorphism rounded-3xl shadow p-6 sticky top-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-6">Ringkasan Belanja</h2>

                    <!-- Summary Details -->
                    <div class="space-y-3 pb-4 border-b border-emerald-200 mb-4">
                        <div class="flex justify-between text-gray-600">
                            <span>Total Produk</span>
                            <span class="font-semibold text-slate-800">{{ $items->count() }} item</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Jumlah Unit</span>
                            <span class="font-semibold text-slate-800">{{ $items->sum('quantity') }} unit</span>
                        </div>
                    </div>

                    <!-- Price Summary -->
                    <div class="space-y-3 mb-6">
                        <div class="flex justify-between text-gray-700">
                            <span>Subtotal</span>
                            <span class="font-semibold">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between text-gray-700">
                            <span>Ongkir (Estimasi)</span>
                            <span class="font-semibold text-emerald-600">Rp 10.000</span>
                        </div>
                        <div class="flex justify-between text-gray-700">
                            <span>Diskon</span>
                            <span class="font-semibold text-red-600">-Rp 0</span>
                        </div>
                    </div>

                    <!-- Total -->
                    <div class="bg-emerald-100/50 p-4 rounded-2xl mb-6 border border-emerald-250">
                        <div class="flex justify-between mb-2">
                            <span class="text-gray-700">Total</span>
                            <span class="text-gray-700">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-bold text-lg text-emerald-800">Total Belanja</span>
                            <span class="font-bold text-lg text-emerald-800">Rp {{ number_format($total + 10000, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <!-- Checkout Button -->
                    <a href="{{ route('pembeli.checkout.index') }}" class="w-full bg-emerald-700 hover:bg-emerald-800 active:scale-[0.98] text-white font-bold py-3.5 rounded-xl transition mb-3 block text-center shadow-lg shadow-emerald-900/10 hover:shadow-emerald-900/20">
                        Lanjutkan Checkout
                    </a>

                    <a href="{{ route('pembeli.dashboard') }}" class="w-full border-2 border-emerald-700 text-emerald-750 hover:bg-emerald-100/50 bg-emerald-50/50 font-bold py-3 rounded-xl transition block text-center">
                        Lanjut Belanja
                    </a>

                    <!-- Keamanan -->
                    <div class="mt-6 pt-6 border-t border-emerald-200 text-center">
                        <p class="text-xs text-gray-600 mb-2">🔒 Belanja Aman & Terpercaya</p>
                        <p class="text-xs text-gray-500">Uang kembali 100% jika produk tidak sesuai</p>
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- Empty Cart -->
        <div class="glassmorphism rounded-3xl shadow p-12 text-center">
            <div class="mb-6">
                <svg class="w-24 h-24 mx-auto text-emerald-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
            </div>

            <h2 class="text-2xl font-bold text-gray-800 mb-2">Keranjang Belanja Kosong</h2>
            <p class="text-gray-650 mb-8">Yuk, mulai berbelanja sekarang dan temukan produk-produk menarik</p>

            <a href="{{ route('pembeli.dashboard') }}" class="inline-block bg-emerald-700 hover:bg-emerald-800 text-white font-bold py-3 px-8 rounded-xl transition">
                Mulai Belanja Sekarang
            </a>
        </div>
    @endif
</div>

<script>
    function increaseQty(btn, itemId, maxStock) {
        const input = btn.previousElementSibling;
        if (parseInt(input.value) < maxStock) {
            input.value = parseInt(input.value) + 1;
            input.form.submit();
        }
    }

    function decreaseQty(btn, itemId) {
        const input = btn.nextElementSibling;
        if (parseInt(input.value) > 1) {
            input.value = parseInt(input.value) - 1;
            input.form.submit();
        }
    }
</script>
@endsection

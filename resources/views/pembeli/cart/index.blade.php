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
                <div class="bg-white rounded-2xl shadow p-6 mb-6">
                    <div class="flex justify-between items-center mb-6">
                        <h1 class="text-2xl font-bold text-gray-800">Keranjang Belanja</h1>
                        <span class="bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold">
                            {{ $items->count() }} produk
                        </span>
                    </div>

                    <div class="space-y-4">
                        @foreach ($items as $item)
                            <div class="border-b border-gray-200 pb-4 last:border-0">
                                <div class="flex gap-4">
                                    <!-- Product Image -->
                                    <div class="w-24 h-24 bg-gray-200 rounded-lg overflow-hidden flex-shrink-0">
                                        @php
                                            $image = $item->product->primaryImage;
                                        @endphp
                                        <img 
                                            src="{{ $image ? asset('storage/' . $image->image_url) : asset('images/no-image.png') }}" 
                                            alt="{{ $item->product->name }}"
                                            class="w-full h-full object-cover"
                                        >
                                    </div>

                                    <!-- Product Info -->
                                    <div class="flex-1">
                                        <a href="{{ route('pembeli.products.show', $item->product->id) }}" class="hover:text-green-600">
                                            <h3 class="font-bold text-gray-800 hover:underline">
                                                {{ $item->product->name }}
                                            </h3>
                                        </a>

                                        <p class="text-sm text-gray-600 mt-1">
                                            Penjual: 
                                            <a href="{{ route('pembeli.sellers.show', $item->product->user->id) }}" class="text-green-600 hover:underline">
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
                                                <button type="button" onclick="decreaseQty(this, {{ $item->id }})" class="bg-gray-200 hover:bg-gray-300 px-2 py-1 rounded">
                                                    −
                                                </button>
                                                <input 
                                                    type="number" 
                                                    name="quantity" 
                                                    value="{{ $item->quantity }}" 
                                                    min="1" 
                                                    max="{{ $item->product->stock }}"
                                                    class="w-12 text-center border border-gray-300 rounded px-2"
                                                    onchange="this.form.submit()"
                                                >
                                                <button type="button" onclick="increaseQty(this, {{ $item->id }}, {{ $item->product->stock }})" class="bg-gray-200 hover:bg-gray-300 px-2 py-1 rounded">
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
                                        <p class="text-gray-600 text-sm mb-2">Subtotal</p>
                                        <p class="font-bold text-lg text-green-600">
                                            Rp {{ number_format($item->getSubtotal(), 0, ',', '.') }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                    <!-- Clear Cart -->
                    <div class="mt-6 pt-6 border-t border-gray-200">
                        <form action="{{ route('pembeli.cart.clear') }}" method="POST" class="inline">
                            @csrf
                            <button type="submit" class="text-red-600 hover:text-red-700 text-sm font-semibold">
                                Kosongkan Keranjang
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Summary Column -->
            <div>
                <div class="bg-white rounded-2xl shadow p-6 sticky top-6">
                    <h2 class="text-xl font-bold text-gray-800 mb-6">Ringkasan Belanja</h2>

                    <!-- Summary Details -->
                    <div class="space-y-3 pb-4 border-b border-gray-200 mb-4">
                        <div class="flex justify-between text-gray-600">
                            <span>Total Produk</span>
                            <span class="font-semibold">{{ $items->count() }} item</span>
                        </div>
                        <div class="flex justify-between text-gray-600">
                            <span>Jumlah Unit</span>
                            <span class="font-semibold">{{ $items->sum('quantity') }} unit</span>
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
                            <span class="font-semibold text-blue-600">Rp 10.000</span>
                        </div>
                        <div class="flex justify-between text-gray-700">
                            <span>Diskon</span>
                            <span class="font-semibold text-red-600">-Rp 0</span>
                        </div>
                    </div>

                    <!-- Total -->
                    <div class="bg-green-50 p-4 rounded-lg mb-6 border border-green-200">
                        <div class="flex justify-between mb-2">
                            <span class="text-gray-700">Total</span>
                            <span class="text-gray-700">Rp {{ number_format($total, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="font-bold text-lg text-green-600">Total Belanja</span>
                            <span class="font-bold text-lg text-green-600">Rp {{ number_format($total + 10000, 0, ',', '.') }}</span>
                        </div>
                    </div>

                    <!-- Checkout Button -->
                    <button class="w-full bg-green-500 hover:bg-green-600 text-white font-bold py-3 rounded-lg transition mb-3">
                        Lanjutkan Checkout
                    </button>

                    <a href="{{ route('pembeli.dashboard') }}" class="w-full border-2 border-green-500 text-green-500 hover:bg-green-50 font-bold py-3 rounded-lg transition block text-center">
                        Lanjut Belanja
                    </a>

                    <!-- Keamanan -->
                    <div class="mt-6 pt-6 border-t border-gray-200 text-center">
                        <p class="text-xs text-gray-600 mb-2">🔒 Belanja Aman & Terpercaya</p>
                        <p class="text-xs text-gray-500">Uang kembali 100% jika produk tidak sesuai</p>
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- Empty Cart -->
        <div class="bg-white rounded-2xl shadow p-12 text-center">
            <div class="mb-6">
                <svg class="w-24 h-24 mx-auto text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 11V7a4 4 0 00-8 0v4M5 9h14l1 12H4L5 9z"/>
                </svg>
            </div>

            <h2 class="text-2xl font-bold text-gray-800 mb-2">Keranjang Belanja Kosong</h2>
            <p class="text-gray-600 mb-8">Yuk, mulai berbelanja sekarang dan temukan produk-produk menarik</p>

            <a href="{{ route('pembeli.dashboard') }}" class="inline-block bg-green-500 hover:bg-green-600 text-white font-bold py-3 px-8 rounded-lg transition">
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

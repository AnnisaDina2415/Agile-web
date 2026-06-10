@extends('layouts.pembeli')

@section('title', 'Profil Penjual - ' . $seller->name . ' - ReGoods')

@section('content')
<div class="max-w-7xl mx-auto">
    <!-- Breadcrumb -->
    <div class="mb-6 text-sm text-gray-600">
        <a href="{{ route('pembeli.dashboard') }}" class="hover:text-green-600">Beranda</a>
        <span class="mx-2">/</span>
        <span class="text-gray-800 font-medium">Penjual: {{ $seller->name }}</span>
    </div>

    <!-- Seller Header -->
    <div class="glassmorphism rounded-3xl shadow p-8 mb-8">
        <div class="flex items-center gap-6 mb-6">
            <div class="w-20 h-20 bg-gradient-to-br from-emerald-800 to-emerald-500 rounded-full flex items-center justify-center shadow-md">
                <span class="text-white font-bold text-3xl">{{ substr($seller->name, 0, 1) }}</span>
            </div>
            <div>
                <h1 class="text-3xl font-bold text-emerald-950">{{ $seller->name }}</h1>
                <p class="text-emerald-750 font-semibold text-sm">Penjual Terpercaya</p>
            </div>
        </div>

        <!-- Seller Stats -->
        <div class="grid grid-cols-4 gap-4">
            <div class="bg-emerald-50/50 border border-emerald-300 p-4 rounded-xl">
                <p class="text-slate-600 text-sm">Rating Toko</p>
                <p class="text-2xl font-bold text-yellow-500 mt-1">4.5 ⭐</p>
            </div>
            <div class="bg-emerald-50/50 border border-emerald-300 p-4 rounded-xl">
                <p class="text-slate-600 text-sm">Produk Aktif</p>
                <p class="text-2xl font-bold text-emerald-800 mt-1">{{ $products->total() }}</p>
            </div>
            <div class="bg-emerald-50/50 border border-emerald-300 p-4 rounded-xl">
                <p class="text-slate-600 text-sm">Penjualan</p>
                <p class="text-2xl font-bold text-emerald-600 mt-1">156 terjual</p>
            </div>
            <div class="bg-emerald-50/50 border border-emerald-300 p-4 rounded-xl">
                <p class="text-slate-600 text-sm">Respon Chat</p>
                <p class="text-2xl font-bold text-green-600 mt-1">Cepat</p>
            </div>
        </div>

        <!-- Contact Button -->
        @if(Auth::id() !== $seller->id)
            <form action="{{ route('chat.start') }}" method="POST" class="inline-block mt-6">
                @csrf
                <input type="hidden" name="user_id" value="{{ $seller->id }}">
                <button type="submit" class="bg-emerald-700 hover:bg-emerald-800 text-white font-bold py-2.5 px-6 rounded-xl shadow transition">
                    💬 Hubungi Penjual
                </button>
            </form>
        @endif
    </div>

    <!-- Products Section -->
    <div>
        <h2 class="text-2xl font-bold text-gray-800 mb-6">Produk dari Toko Ini</h2>

        @if ($products->count() > 0)
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach ($products as $product)
                    <div class="glassmorphism rounded-3xl overflow-hidden card-hover-animation flex flex-col h-full shadow-sm">
                        @php
                            $image = $product->primaryImage;
                        @endphp

                        <a href="{{ route('pembeli.products.show', $product->id) }}" class="block relative aspect-square overflow-hidden bg-slate-100">
                            <img 
                                src="{{ $image ? (Str::startsWith($image->image_url, ['http://', 'https://']) ? $image->image_url : asset('storage/' . $image->image_url)) : asset('images/no-image.png') }}" 
                                class="w-full h-full object-cover hover:scale-105 transition"
                                alt="{{ $product->name }}"
                            >
                        </a>

                        <div class="p-4 flex-1 flex flex-col justify-between">
                            <div>
                                <a href="{{ route('pembeli.products.show', $product->id) }}" class="hover:text-emerald-700">
                                    <h3 class="font-semibold text-gray-800 line-clamp-2">
                                        {{ $product->name }}
                                    </h3>
                                </a>

                                <p class="text-emerald-700 font-extrabold mt-2">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </p>

                                <div class="flex gap-2 mt-3">
                                    <span class="text-[10px] bg-slate-200 px-2 py-0.5 rounded-full uppercase font-bold text-slate-700">
                                        {{ $product->condition }}
                                    </span>
                                    <span class="text-[10px] bg-emerald-100 text-emerald-850 px-2 py-0.5 rounded-full font-bold">
                                        Stok: {{ $product->stock }}
                                    </span>
                                </div>
                            </div>

                            <div class="flex gap-2 mt-4">
                                <a href="{{ route('pembeli.products.show', $product->id) }}" class="flex-1 bg-emerald-50/50 hover:bg-emerald-700 hover:text-white text-emerald-700 border border-emerald-300 py-2 rounded-xl text-center text-sm font-semibold transition">
                                    Lihat
                                </a>
                                <form action="{{ route('pembeli.cart.add') }}" method="POST" class="flex-1">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                    <input type="hidden" name="quantity" value="1">
                                    <button type="submit" class="w-full bg-emerald-700 hover:bg-emerald-800 text-white py-2 rounded-xl text-sm font-semibold transition">
                                        🛒 +
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            @if ($products->hasPages())
                <div class="mt-8">
                    {{ $products->links() }}
                </div>
            @endif
        @else
            <div class="bg-gray-50 rounded-2xl p-12 text-center">
                <p class="text-gray-600 text-lg">Penjual ini belum memiliki produk</p>
            </div>
        @endif
    </div>
</div>
@endsection

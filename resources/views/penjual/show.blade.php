@extends('layouts.penjual-new')

@section('title', $product->name)

@section('content')

<div class="max-w-3xl">
    <a href="{{ route('penjual.produk.index') }}" class="text-[#064e3b] hover:text-[#059669] text-sm font-semibold mb-4 inline-block">← Kembali</a>

    <div class="glassmorphism rounded-3xl p-6 shadow-sm">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Gambar -->
            <div>
                @if($product->image)
                    <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" class="w-full h-auto object-cover rounded-2xl border border-emerald-300">
                @else
                    <div class="w-full h-64 bg-emerald-50/50 border border-emerald-300 rounded-2xl flex items-center justify-center">
                        <span class="text-slate-400">Tidak ada gambar</span>
                    </div>
                @endif
            </div>

            <!-- Info Produk -->
            <div>
                <h1 class="text-2xl font-extrabold text-gray-800 mb-4">{{ $product->name }}</h1>
                
                <div class="mb-6">
                    <p class="text-3xl font-extrabold text-[#064e3b]">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                </div>

                <div class="mb-4">
                    <p class="text-sm text-gray-650 font-semibold">Stok Tersedia</p>
                    <p class="text-xl font-bold text-gray-800">{{ $product->stock }} unit</p>
                </div>

                <div class="mb-6 pb-6 border-b border-emerald-250">
                    <p class="text-sm text-gray-600 font-semibold mb-2">Deskripsi</p>
                    <p class="text-gray-700 leading-relaxed text-sm">{{ $product->description ?? 'Tidak ada deskripsi' }}</p>
                </div>

                <div class="flex gap-3">
                    <a href="{{ route('penjual.produk.edit', $product) }}" class="flex-1 bg-[#064e3b] hover:bg-[#059669] text-white px-4 py-2.5 rounded-xl font-semibold text-center transition">
                        ✏️ Edit
                    </a>
                    <form action="{{ route('penjual.produk.destroy', $product) }}" method="post" class="flex-1">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="w-full bg-red-500 hover:bg-red-600 text-white px-4 py-2.5 rounded-xl font-semibold transition" onclick="return confirm('Hapus produk ini? Tindakan ini tidak dapat dibatalkan.')">
                            🗑️ Hapus
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

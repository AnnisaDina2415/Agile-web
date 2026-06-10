@extends('layouts.penjual-new')

@section('title', 'Kelola Produk')

@section('content')

<div class="glassmorphism rounded-3xl shadow p-6">
    <div class="flex items-center justify-between mb-6">
        <h2 class="text-lg font-bold text-gray-800">Kelola Produk Saya</h2>
        <a href="{{ route('penjual.produk.create') }}" class="bg-[#064e3b] hover:bg-[#059669] text-white px-4 py-2 rounded-xl font-semibold transition">
            + Tambah Produk
        </a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-3 bg-brand-100 text-brand-900 rounded-xl border border-brand-200">{{ session('success') }}</div>
    @endif

    @if($products->count())
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-emerald-50/50 border-b border-emerald-250">
                    <tr>
                        <th class="px-4 py-3 text-left font-semibold text-emerald-950">Nama Produk</th>
                        <th class="px-4 py-3 text-left font-semibold text-emerald-950">Harga</th>
                        <th class="px-4 py-3 text-left font-semibold text-emerald-950">Stok</th>
                        <th class="px-4 py-3 text-left font-semibold text-emerald-950">Status</th>
                        <th class="px-4 py-3 text-left font-semibold text-emerald-950">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr class="border-b border-emerald-100/50 hover:bg-emerald-50/30">
                        <td class="px-4 py-3 text-gray-800 font-semibold">{{ $product->name }}</td>
                        <td class="px-4 py-3 text-gray-600">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                        <td class="px-4 py-3">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold {{ $product->stock > 0 ? 'bg-brand-100 text-brand-800' : 'bg-red-100 text-red-700' }}">
                                {{ $product->stock }}
                            </span>
                        </td>
                        <td class="px-4 py-3">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-800 border border-emerald-250">
                                {{ ucfirst($product->status) }}
                            </span>
                        </td>
                        <td class="px-4 py-3 flex gap-2">
                            <a href="{{ route('penjual.produk.edit', $product) }}" class="px-3 py-1 text-sm bg-yellow-100 text-yellow-700 rounded-lg hover:bg-yellow-200 transition">Edit</a>
                            <form action="{{ route('penjual.produk.destroy', $product) }}" method="post" class="inline">
                                @csrf
                                @method('DELETE')
                                <button class="px-3 py-1 text-sm bg-red-100 text-red-700 rounded-lg hover:bg-red-200 transition" onclick="return confirm('Hapus produk ini?')">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-4">{{ $products->links() }}</div>
    @else
        <div class="text-center py-12">
            <p class="text-gray-500 text-lg mb-4">Tidak ada produk</p>
            <a href="{{ route('penjual.produk.create') }}" class="inline-block bg-[#064e3b] hover:bg-[#059669] text-white px-6 py-2.5 rounded-xl font-semibold transition shadow-sm">
                Buat Produk Pertama
            </a>
        </div>
    @endif
</div>

@endsection

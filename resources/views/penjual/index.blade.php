@extends('layouts.penjual')

@section('header', 'Kelola Produk')

@section('content')
<div>
    <div class="flex items-center justify-between mb-6">
        <h3 class="text-lg font-semibold">Daftar Produk Saya</h3>
        <a href="{{ route('penjual.produk.create') }}" class="bg-green-500 text-white px-3 py-2 rounded">Tambah Produk</a>
    </div>

    @if(session('success'))
        <div class="mb-4 p-3 bg-green-50 text-green-700 rounded">{{ session('success') }}</div>
    @endif

    @if($products->count())
        <div class="grid grid-cols-1 gap-4">
            @foreach($products as $product)
                <div class="p-4 bg-white shadow rounded flex items-center justify-between">
                    <div>
                        <a href="{{ route('penjual.produk.show', $product) }}" class="font-semibold">{{ $product->title }}</a>
                        <div class="text-sm text-gray-500">Rp {{ number_format($product->price, 2) }} — Stok: {{ $product->quantity }}</div>
                    </div>
                    <div class="space-x-2">
                        <a href="{{ route('penjual.produk.edit', $product) }}" class="px-3 py-1 bg-yellow-100 rounded">Edit</a>
                        <form action="{{ route('penjual.produk.destroy', $product) }}" method="post" class="inline">
                            @csrf
                            @method('DELETE')
                            <button class="px-3 py-1 bg-red-100 rounded" onclick="return confirm('Hapus produk ini?')">Hapus</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4">{{ $products->links() }}</div>
    @else
        <p class="text-gray-600">Tidak ada produk.</p>
    @endif
</div>
@endsection

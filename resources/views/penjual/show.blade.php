@extends('layouts.penjual')

@section('header', $product->title)

@section('content')
<div class="bg-white p-6 shadow rounded max-w-3xl">
    @if($product->image)
        <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->title }}" class="mb-4 max-w-sm">
    @endif

    <div class="mb-2"><strong>Harga:</strong> Rp {{ number_format($product->price, 2) }}</div>
    <div class="mb-2"><strong>Stok:</strong> {{ $product->quantity }}</div>
    <div class="mb-2"><strong>Deskripsi:</strong></div>
    <div class="p-2 border bg-gray-50">{{ $product->description }}</div>

    <div class="mt-4">
        <a href="{{ route('penjual.produk.index') }}" class="px-3 py-2 border rounded">Kembali</a>
    </div>
</div>
@endsection

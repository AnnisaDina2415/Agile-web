@extends('layouts.penjual')

@section('header', 'Tambah Produk')

@section('content')
<div class="max-w-2xl">
    @if($errors->any())
        <div class="mb-4 p-3 bg-red-50 text-red-700 rounded">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('penjual.produk.store') }}" method="post" enctype="multipart/form-data" class="bg-white p-6 shadow rounded">
        @csrf
        <div class="mb-4">
            <label class="block text-sm text-gray-700 mb-1">Judul</label>
            <input type="text" name="title" value="{{ old('title') }}" class="w-full border rounded px-3 py-2">
        </div>
        <div class="mb-4">
            <label class="block text-sm text-gray-700 mb-1">Deskripsi</label>
            <textarea name="description" class="w-full border rounded px-3 py-2">{{ old('description') }}</textarea>
        </div>
        <div class="grid grid-cols-2 gap-4 mb-4">
            <div>
                <label class="block text-sm text-gray-700 mb-1">Harga</label>
                <input type="number" step="0.01" name="price" value="{{ old('price') }}" class="w-full border rounded px-3 py-2">
            </div>
            <div>
                <label class="block text-sm text-gray-700 mb-1">Jumlah</label>
                <input type="number" name="quantity" value="{{ old('quantity', 1) }}" class="w-full border rounded px-3 py-2">
            </div>
        </div>
        <div class="mb-4">
            <label class="block text-sm text-gray-700 mb-1">Gambar (opsional)</label>
            <input type="file" name="image" class="w-full">
        </div>

        <div class="flex gap-2">
            <button class="bg-green-500 text-white px-4 py-2 rounded">Simpan</button>
            <a href="{{ route('penjual.produk.index') }}" class="px-4 py-2 rounded border">Batal</a>
        </div>
    </form>
</div>
@endsection

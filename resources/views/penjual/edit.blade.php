@extends('layouts.penjual-new')

@section('title', 'Edit Produk')

@section('content')

<div class="max-w-2xl">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Edit Produk</h1>

    @if($errors->any())
        <div class="mb-4 p-4 bg-red-50 text-red-700 rounded-lg border border-red-200">
            <p class="font-semibold mb-2">Error:</p>
            <ul class="list-disc list-inside">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('penjual.produk.update', $product) }}" method="post" enctype="multipart/form-data" class="glassmorphism rounded-3xl p-6 shadow-sm">
        @csrf
        @method('PUT')
        
        <div class="mb-6">
            <label class="block text-sm font-semibold text-emerald-950 mb-2">Nama Produk</label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}" placeholder="Masukkan nama produk" class="w-full bg-emerald-50/70 border border-emerald-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 outline-none text-slate-800">
        </div>

        <div class="mb-6">
            <label class="block text-sm font-semibold text-emerald-950 mb-2">Kategori</label>
            <select name="category_id" class="w-full bg-emerald-50/70 border border-emerald-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 outline-none text-slate-850">
                <option value="">Pilih kategori</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-6">
            <label class="block text-sm font-semibold text-emerald-950 mb-2">Deskripsi</label>
            <textarea name="description" placeholder="Jelaskan produk Anda" class="w-full bg-emerald-50/70 border border-emerald-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 outline-none text-slate-800" rows="4">{{ old('description', $product->description) }}</textarea>
        </div>

        <div class="grid grid-cols-2 gap-4 mb-6">
            <div>
                <label class="block text-sm font-semibold text-emerald-950 mb-2">Harga (Rp)</label>
                <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" placeholder="0" class="w-full bg-emerald-50/70 border border-emerald-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 outline-none text-slate-800">
            </div>
            <div>
                <label class="block text-sm font-semibold text-emerald-950 mb-2">Stok</label>
                <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" placeholder="1" class="w-full bg-emerald-50/70 border border-emerald-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 outline-none text-slate-800">
            </div>
        </div>

        <div class="mb-6">
            <label class="block text-sm font-semibold text-emerald-950 mb-2">Kondisi</label>
            <select name="condition" class="w-full bg-emerald-50/70 border border-emerald-300 rounded-xl px-4 py-2 focus:ring-2 focus:ring-emerald-400 focus:border-emerald-400 outline-none text-slate-850" required>
                <option value="">Pilih kondisi</option>
                <option value="Sangat Baik" {{ old('condition', $product->condition) == 'Sangat Baik' ? 'selected' : '' }}>Sangat Baik</option>
                <option value="Baik" {{ old('condition', $product->condition) == 'Baik' ? 'selected' : '' }}>Baik</option>
                <option value="Cukup" {{ old('condition', $product->condition) == 'Cukup' ? 'selected' : '' }}>Cukup</option>
                <option value="Rusak Ringan" {{ old('condition', $product->condition) == 'Rusak Ringan' ? 'selected' : '' }}>Rusak Ringan</option>
            </select>
        </div>

        @if($product->image)
        <div class="mb-6">
            <label class="block text-sm font-semibold text-emerald-950 mb-2">Gambar Saat Ini</label>
            <img src="{{ asset('storage/'.$product->image) }}" alt="{{ $product->name }}" class="w-32 h-32 object-cover rounded-xl border border-emerald-300">
        </div>
        @endif

        <div class="mb-6">
            <label class="block text-sm font-semibold text-emerald-950 mb-2">Ganti Gambar Produk</label>
            <input type="file" name="image" class="w-full bg-emerald-50/40 border-2 border-dashed border-emerald-300 rounded-xl px-4 py-6 cursor-pointer hover:border-emerald-500" accept="image/*">
            <p class="text-xs text-slate-500 mt-2">Format: JPG, JPEG, PNG, WEBP. Ukuran maks: 2MB (Kosongkan jika tidak ingin mengganti)</p>
        </div>

        <div class="flex gap-3">
            <button type="submit" class="bg-[#064e3b] hover:bg-[#059669] text-white px-6 py-2.5 rounded-xl font-semibold transition">Perbarui Produk</button>
            <a href="{{ route('penjual.produk.index') }}" class="bg-emerald-50 hover:bg-emerald-100 text-emerald-800 px-6 py-2.5 rounded-xl font-semibold transition border border-emerald-300">Batal</a>
        </div>
    </form>
</div>

@endsection

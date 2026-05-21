@extends('layouts.pembeli')

@section('title', 'Profile - ReGoods')

@section('content')
<div class="max-w-4xl mx-auto py-8 px-4">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <!-- Sidebar -->
        <div class="md:col-span-1">
            <div class="bg-white rounded-2xl shadow p-6">
                <div class="text-center">
                    <div class="w-24 h-24 mx-auto bg-blue-100 rounded-full flex items-center justify-center text-3xl font-bold text-blue-600 mb-4">
                        {{ substr($user->name, 0, 1) }}
                    </div>
                    <h2 class="text-xl font-bold text-gray-800">{{ $user->name }}</h2>
                    <p class="text-gray-500 text-sm mt-1">{{ $user->email }}</p>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="md:col-span-2">
            @if (session('success'))
                <div class="mb-4 p-4 bg-green-100 text-green-700 rounded-lg">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="mb-4 p-4 bg-red-100 text-red-700 rounded-lg">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Profile Information -->
            <div class="bg-white rounded-2xl shadow p-6 mb-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Informasi Profil</h3>
                <div class="space-y-3">
                    <div class="flex justify-between items-center py-2 border-b">
                        <span class="text-gray-600">Nama</span>
                        <span class="text-gray-800 font-medium">{{ $user->name }}</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b">
                        <span class="text-gray-600">Email</span>
                        <span class="text-gray-800 font-medium">{{ $user->email }}</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b">
                        <span class="text-gray-600">Telepon</span>
                        <span class="text-gray-800 font-medium">{{ $user->phone ?? '-' }}</span>
                    </div>
                    <div class="flex justify-between items-center py-2">
                        <span class="text-gray-600">Alamat</span>
                        <span class="text-gray-800 font-medium">{{ $user->address ?? '-' }}</span>
                    </div>
                </div>
                <a href="{{ route('pembeli.profile.edit') }}" class="mt-4 inline-block bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg font-medium transition">
                    ✏️ Edit Profil
                </a>
            </div>

            <!-- Mode Penjual -->
            <div class="bg-white rounded-2xl shadow p-6">
                <h3 class="text-lg font-bold text-gray-800 mb-4">Mode Penjual</h3>

                @if ($isSellerRoleExists)
                    <!-- User sudah punya role penjual -->
                    <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-4">
                        <p class="text-green-700 font-medium">✓ Anda sudah terdaftar sebagai penjual</p>
                    </div>
                    <a href="{{ route('penjual.dashboard') }}" class="inline-block bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg font-medium transition">
                        📊 Masuk ke Dashboard Penjual
                    </a>
                @else
                    <!-- User belum punya role penjual -->
                    @if ($sellerApplication)
                        @if ($sellerApplication->isPending())
                            <div class="bg-yellow-50 border border-yellow-200 rounded-lg p-4 mb-4">
                                <p class="text-yellow-700 font-medium">⏳ Pengajuan Anda sedang ditinjau oleh admin</p>
                                <p class="text-yellow-600 text-sm mt-1">Silahkan tunggu persetujuan dalam beberapa hari kerja</p>
                            </div>
                        @elseif ($sellerApplication->isRejected())
                            <div class="bg-red-50 border border-red-200 rounded-lg p-4 mb-4">
                                <p class="text-red-700 font-medium">❌ Pengajuan Anda ditolak</p>
                                <p class="text-red-600 text-sm mt-1">Alasan: {{ $sellerApplication->rejection_reason }}</p>
                            </div>
                            <form action="{{ route('pembeli.profile.upload-ktp') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                                @csrf
                                <div>
                                    <label class="block text-gray-600 font-medium mb-2">Upload Foto KTP</label>
                                    <input type="file" name="ktp_image" accept="image/*" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:border-blue-500">
                                    @error('ktp_image')
                                        <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                                </div>
                                <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg font-medium transition">
                                    Kirim Ulang KTP
                                </button>
                            </form>
                        @endif
                    @else
                        <!-- User belum submit KTP sama sekali -->
                        <p class="text-gray-600 mb-4">Untuk menjadi penjual, silahkan upload foto KTP Anda</p>
                        <form action="{{ route('pembeli.profile.upload-ktp') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                            @csrf
                            <div>
                                <label class="block text-gray-600 font-medium mb-2">Upload Foto KTP</label>
                                <input type="file" name="ktp_image" accept="image/*" required class="w-full border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:border-blue-500">
                                @error('ktp_image')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg font-medium transition">
                                Ajukan Permohonan Penjual
                            </button>
                        </form>
                    @endif
                @endif
            </div>
        </div>
    </div>
</div>

@endsection

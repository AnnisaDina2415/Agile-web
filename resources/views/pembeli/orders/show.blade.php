@extends('layouts.pembeli')

@section('title', 'Detail Pesanan ' . $order->order_number . ' - ReGoods')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <!-- Breadcrumb -->
    <div class="text-sm text-slate-500 flex items-center gap-2">
        <a href="{{ route('pembeli.dashboard') }}" class="hover:text-green-600 transition">Beranda</a>
        <span>/</span>
        <a href="{{ route('pembeli.orders.index') }}" class="hover:text-green-600 transition">Transaksi</a>
        <span>/</span>
        <span class="text-slate-800 font-medium">{{ $order->order_number }}</span>
    </div>

    <!-- Alert Success -->
    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 px-5 py-4 rounded-2xl text-sm" role="alert">
            <p class="font-bold">Berhasil!</p>
            <p class="mt-1">{{ session('success') }}</p>
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Order Details -->
        <div class="md:col-span-2 space-y-6">
            <!-- Order Header Status Card -->
            <div class="glassmorphism rounded-3xl p-6 md:p-8 space-y-6 shadow-sm">
                <div class="flex justify-between items-start">
                    <div>
                        <span class="text-xs font-semibold text-slate-400 uppercase tracking-wider">No. Invoice</span>
                        <h1 class="text-lg md:text-xl font-bold text-slate-800">{{ $order->order_number }}</h1>
                        <p class="text-xs text-slate-400 mt-1">Dibuat pada: {{ $order->created_at->format('d M Y, H:i') }}</p>
                    </div>

                    <!-- Status Badges -->
                    @if($order->status === 'paid')
                        <span class="bg-green-50 text-green-700 border border-green-200 text-xs font-bold px-3 py-1.5 rounded-full uppercase tracking-wider">Lunas</span>
                    @elseif($order->status === 'pending')
                        <span class="bg-amber-50 text-amber-700 border border-amber-200 text-xs font-bold px-3 py-1.5 rounded-full uppercase tracking-wider">Menunggu Pembayaran</span>
                    @elseif($order->status === 'cancelled')
                        <span class="bg-rose-50 text-rose-700 border border-rose-200 text-xs font-bold px-3 py-1.5 rounded-full uppercase tracking-wider">Dibatalkan</span>
                    @else
                        <span class="bg-slate-50 text-slate-700 border border-slate-200 text-xs font-bold px-3 py-1.5 rounded-full uppercase tracking-wider">{{ ucfirst($order->status) }}</span>
                    @endif
                </div>

                <!-- Products list -->
                <div class="border-t border-emerald-250 pt-6">
                    <h3 class="font-bold text-slate-800 text-sm mb-4">Daftar Barang</h3>
                    <div class="divide-y divide-emerald-100">
                        @foreach($order->items as $item)
                             <div class="py-4 flex gap-4 first:pt-0 last:pb-0">
                                 <div class="w-16 h-16 bg-slate-100 rounded-xl overflow-hidden flex-shrink-0">
                                     <img src="{{ $item->product->primaryImage ? (Str::startsWith($item->product->primaryImage->image_url, ['http://', 'https://']) ? $item->product->primaryImage->image_url : asset('storage/' . $item->product->primaryImage->image_url)) : asset('images/no-image.png') }}" 
                                         alt="{{ $item->product->name }}" class="w-full h-full object-cover">
                                 </div>
                                 <div class="flex-1 min-w-0">
                                     <h4 class="font-bold text-slate-800 text-sm truncate hover:text-emerald-700">
                                         <a href="{{ route('pembeli.products.show', $item->product->id) }}">{{ $item->product->name }}</a>
                                     </h4>
                                     <p class="text-xs text-slate-450 mt-0.5">Penjual: {{ $item->product->user->name ?? 'Anonim' }}</p>
                                     <p class="text-xs text-slate-550 mt-1">{{ $item->quantity }} x Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                 </div>
                                 <div class="text-right">
                                     <span class="font-bold text-slate-800 text-sm">Rp {{ number_format($item->getSubtotal(), 0, ',', '.') }}</span>
                                 </div>
                             </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Shipping Information -->
            <div class="glassmorphism rounded-3xl p-6 md:p-8 space-y-4 shadow-sm">
                <h3 class="font-bold text-slate-800 text-base">Alamat Pengiriman</h3>
                <div class="text-sm text-slate-600 space-y-2">
                    <p class="font-semibold text-slate-800">{{ $order->user->name }}</p>
                    <p>Telepon: {{ $order->phone ?? '-' }}</p>
                    <p class="leading-relaxed">Alamat: {{ $order->address ?? '-' }}</p>
                </div>
            </div>
        </div>

        <!-- Payment Actions Sidebar -->
        <div>
            <div class="glassmorphism rounded-3xl p-6 sticky top-24 space-y-6 shadow-sm">
                <h3 class="font-bold text-slate-800 text-lg">Detail Pembayaran</h3>
                
                <div class="space-y-3 text-sm">
                    <div class="flex justify-between text-slate-500">
                        <span>Harga Barang</span>
                        <span class="font-semibold text-slate-800">Rp {{ number_format($order->total_price - 10000, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between text-slate-500">
                        <span>Ongkos Kirim</span>
                        <span class="font-semibold text-slate-800">Rp 10.000</span>
                    </div>
                    <div class="pt-3 border-t border-emerald-250 flex justify-between items-center font-bold text-base">
                        <span class="text-slate-800">Total Tagihan</span>
                        <span class="text-emerald-800">Rp {{ number_format($order->total_price, 0, ',', '.') }}</span>
                    </div>
                </div>

                @if($order->status === 'pending' && $order->snap_token)
                    <div class="pt-4 border-t border-emerald-250 space-y-3">
                        <p class="text-xs text-amber-600 font-medium">⚠️ Selesaikan pembayaran Anda melalui portal Midtrans untuk memproses pesanan ini.</p>
                        
                        <button id="pay-button" class="w-full bg-emerald-700 hover:bg-emerald-800 active:scale-[0.98] text-white font-bold py-3.5 rounded-2xl shadow-lg shadow-emerald-900/10 hover:shadow-emerald-900/20 transition-all duration-200 text-center block cursor-pointer">
                            Bayar Sekarang
                        </button>
                    </div>
                @elseif($order->status === 'paid')
                    <div class="pt-4 border-t border-emerald-250 text-center space-y-2">
                        <p class="text-3xl">🎉</p>
                        <p class="text-sm font-bold text-green-600">Pembayaran Sukses</p>
                        <p class="text-xs text-slate-500 font-medium">Terima kasih telah berbelanja di ReGoods! Barang Anda sedang diproses oleh penjual.</p>
                    </div>
                @elseif($order->status === 'cancelled')
                    <div class="pt-4 border-t border-emerald-250 text-center text-rose-600 font-medium text-sm">
                        Transaksi ini telah dibatalkan.
                    </div>
                @elseif($order->status === 'expired')
                    <div class="pt-4 border-t border-emerald-250 text-center text-slate-500 font-medium text-sm">
                        Waktu pembayaran telah habis (Expired).
                    </div>
                @endif

                <a href="{{ route('pembeli.orders.index') }}" class="w-full border border-emerald-700 text-emerald-750 hover:bg-emerald-100/50 bg-emerald-50/50 font-semibold py-3 rounded-2xl transition block text-center text-sm">
                    Lihat Semua Transaksi
                </a>
            </div>
        </div>
    </div>
</div>

@if($order->status === 'pending' && $order->snap_token)
    <!-- Midtrans Snap JS -->
    <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
    <script type="text/javascript">
        function triggerPayment() {
            window.snap.pay('{{ $order->snap_token }}', {
                onSuccess: function(result){
                    console.log('payment success', result);
                    window.location.reload();
                },
                onPending: function(result){
                    console.log('payment pending', result);
                    window.location.reload();
                },
                onError: function(result){
                    console.log('payment error', result);
                    window.location.reload();
                },
                onClose: function(){
                    console.log('customer closed the popup without finishing the payment');
                    alert('Anda menutup jendela pembayaran sebelum transaksi selesai.');
                }
            });
        }

        const payButton = document.getElementById('pay-button');
        if (payButton) {
            payButton.addEventListener('click', triggerPayment);
        }
    </script>
@endif
@endsection

@extends('layouts.pembeli')

@section('title', 'Transaksi Saya - ReGoods')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">
    <!-- Breadcrumb -->
    <div class="text-sm text-slate-500 flex items-center gap-2">
        <a href="{{ route('pembeli.dashboard') }}" class="hover:text-green-600 transition">Beranda</a>
        <span>/</span>
        <span class="text-slate-800 font-medium">Transaksi Saya</span>
    </div>

    <div class="glassmorphism rounded-3xl shadow-sm p-6 md:p-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-bold text-slate-800">Riwayat Belanja</h1>
            <span class="bg-emerald-100 text-emerald-800 font-bold px-3 py-1.5 rounded-full text-xs border border-emerald-300">
                Total: {{ $orders->total() }} transaksi
            </span>
        </div>

        @if($orders->count() > 0)
            <div class="space-y-4">
                @foreach($orders as $order)
                    <div class="border border-emerald-250/70 rounded-2xl p-5 hover:border-emerald-400 transition duration-200 bg-emerald-50/40">
                        <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
                            <!-- Left Info -->
                            <div class="space-y-2">
                                <div class="flex items-center gap-3">
                                    <span class="font-bold text-slate-800 text-sm md:text-base">{{ $order->order_number }}</span>
                                    <span class="text-xs text-slate-400">• {{ $order->created_at->format('d M Y, H:i') }}</span>
                                </div>
                                
                                <!-- Products snippet -->
                                <div class="text-xs text-slate-500">
                                    @php
                                        $firstItem = $order->items->first();
                                        $otherItemsCount = $order->items->count() - 1;
                                    @endphp
                                    @if($firstItem)
                                        <span>{{ $firstItem->product->name ?? 'Barang Terhapus' }} ({{ $firstItem->quantity }}x)</span>
                                        @if($otherItemsCount > 0)
                                            <span class="text-slate-400 font-medium ml-1">dan {{ $otherItemsCount }} barang lainnya</span>
                                        @endif
                                    @endif
                                </div>
                            </div>

                            <!-- Right Info & Actions -->
                            <div class="flex items-center justify-between md:justify-end gap-6 border-t border-emerald-100 md:border-t-0 pt-3 md:pt-0">
                                <div class="text-left md:text-right space-y-0.5">
                                    <p class="text-[10px] text-slate-500 font-medium uppercase tracking-wider">Total Belanja</p>
                                    <p class="font-extrabold text-slate-800 text-sm md:text-base">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                                </div>

                                <div class="flex items-center gap-3">
                                    <!-- Status Pill -->
                                    @if($order->status === 'paid')
                                        <span class="bg-green-50 text-green-700 border border-green-200 text-[10px] font-bold px-2.5 py-1 rounded-full uppercase tracking-wider">Lunas</span>
                                    @elseif($order->status === 'pending')
                                        <span class="bg-amber-50 text-amber-700 border border-amber-200 text-[10px] font-bold px-2.5 py-1 rounded-full uppercase tracking-wider">Pending</span>
                                    @elseif($order->status === 'cancelled')
                                        <span class="bg-rose-50 text-rose-700 border border-rose-200 text-[10px] font-bold px-2.5 py-1 rounded-full uppercase tracking-wider">Batal</span>
                                    @else
                                        <span class="bg-slate-50 text-slate-700 border border-slate-200 text-[10px] font-bold px-2.5 py-1 rounded-full uppercase tracking-wider">{{ $order->status }}</span>
                                    @endif

                                    <a href="{{ route('pembeli.orders.show', $order->id) }}" class="bg-emerald-50/50 hover:bg-emerald-700 hover:text-white text-emerald-700 text-xs font-bold px-4 py-2 rounded-xl border border-emerald-300 transition duration-200">
                                        Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $orders->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div class="text-center py-12 space-y-4">
                <div class="text-4xl">🧾</div>
                <h3 class="font-bold text-slate-800 text-lg">Belum Ada Transaksi</h3>
                <p class="text-slate-500 text-sm max-w-xs mx-auto">Anda belum pernah melakukan pemesanan. Yuk cari barang menarik sekarang!</p>
                <a href="{{ route('pembeli.dashboard') }}" class="inline-block bg-emerald-700 hover:bg-emerald-800 text-white font-bold py-2.5 px-6 rounded-2xl shadow transition text-sm">
                    Mulai Belanja
                </a>
            </div>
        @endif
    </div>
</div>
@endsection

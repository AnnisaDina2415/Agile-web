@extends('admin.layouts.app')

@section('title', 'Detail Pesanan')
@section('page-title', 'Detail Pesanan')

@section('content')
<div class="max-w-4xl mx-auto space-y-6">
    <div class="glassmorphism rounded-3xl p-6 shadow-sm">
        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-slate-500 text-sm">ID Pesanan</p>
                <p class="text-xl font-bold text-brand-800">#{{ $order['id'] }}</p>
            </div>
            <div class="text-right">
                <p class="text-slate-500 text-sm">Tanggal</p>
                <p class="text-base font-semibold text-slate-800">{{ $order['date'] }}</p>
            </div>
        </div>

        <div class="mt-6 grid gap-4 sm:grid-cols-3">
            <div class="rounded-2xl bg-emerald-50/40 p-4 border border-brand-200/55">
                <p class="text-xs text-slate-500 uppercase tracking-[0.15em] mb-2 font-semibold">Pembeli</p>
                <p class="text-sm font-semibold text-slate-850">{{ $order['buyer'] }}</p>
            </div>
            <div class="rounded-2xl bg-emerald-50/40 p-4 border border-brand-200/55">
                <p class="text-xs text-slate-500 uppercase tracking-[0.15em] mb-2 font-semibold">Total</p>
                <p class="text-sm font-semibold text-slate-850">{{ $order['total'] }}</p>
            </div>
            <div class="rounded-2xl bg-emerald-50/40 p-4 border border-brand-200/55">
                <p class="text-xs text-slate-500 uppercase tracking-[0.15em] mb-2 font-semibold">Status</p>
                <p class="text-sm font-semibold text-slate-850">{{ $order['status'] }}</p>
            </div>
        </div>
    </div>

    <div class="glassmorphism rounded-3xl p-6 shadow-sm">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-lg font-bold text-slate-850">Item Pesanan</h2>
            <a href="{{ route('admin.orders.index') }}" class="text-brand-700 hover:text-brand-600 font-semibold">Kembali ke daftar</a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full text-left text-sm divide-y divide-brand-200/50">
                <thead class="bg-emerald-50/50 text-slate-800 border-b border-brand-200/50">
                    <tr>
                        <th class="px-6 py-3 font-semibold">Nama Item</th>
                        <th class="px-6 py-3 font-semibold">Jumlah</th>
                        <th class="px-6 py-3 font-semibold">Harga</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-brand-100/40">
                    @foreach($order['items'] as $item)
                    <tr class="hover:bg-emerald-50/30">
                        <td class="px-6 py-4 text-slate-800 font-semibold">{{ $item['name'] }}</td>
                        <td class="px-6 py-4 text-slate-500">{{ $item['qty'] }}</td>
                        <td class="px-6 py-4 text-slate-500">{{ $item['price'] }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

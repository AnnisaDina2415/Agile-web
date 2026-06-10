@extends('admin.layouts.app')

@section('title', 'History Transaksi')
@section('page-title', 'History Transaksi')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <p class="text-sm text-slate-500">Lihat riwayat semua transaksi di platform.</p>
    </div>
</div>

<div class="glassmorphism rounded-3xl shadow-sm overflow-hidden">
    <table class="min-w-full text-left text-sm divide-y divide-brand-200/50">
        <thead class="bg-emerald-50/50 text-slate-800 border-b border-brand-200/50">
            <tr>
                <th class="px-6 py-3 font-semibold">ID Transaksi</th>
                <th class="px-6 py-3 font-semibold">Pembeli</th>
                <th class="px-6 py-3 font-semibold">Total</th>
                <th class="px-6 py-3 font-semibold">Tanggal</th>
                <th class="px-6 py-3 font-semibold">Status</th>
                <th class="px-6 py-3 font-semibold">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-brand-100/40">
            @forelse($orders as $order)
            <tr class="hover:bg-emerald-50/30">
                <td class="px-6 py-4 text-slate-700 font-semibold">#{{ $order['id'] }}</td>
                <td class="px-6 py-4 text-slate-500">{{ $order['buyer'] }}</td>
                <td class="px-6 py-4 text-slate-500">{{ $order['total'] }}</td>
                <td class="px-6 py-4 text-slate-500">{{ $order['date'] }}</td>
                <td class="px-6 py-4">
                    <span class="inline-flex items-center rounded-full px-3 py-1 text-[11px] font-semibold {{ $order['status'] === 'Menunggu' ? 'bg-yellow-50 text-yellow-600' : ($order['status'] === 'Dikirim' ? 'bg-brand-100 text-brand-800' : 'bg-emerald-100 text-emerald-800 border border-emerald-250') }}">
                        {{ $order['status'] }}
                    </span>
                </td>
                <td class="px-6 py-4">
                    <a href="{{ route('admin.orders.show', $order['id']) }}" class="text-brand-700 hover:text-brand-600 font-semibold">Detail</a>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="px-6 py-8 text-center text-slate-500">Belum ada transaksi.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection

@extends('admin.layouts.app')

@section('title', 'Kelola Admin')
@section('page-title', 'Kelola Admin')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <p class="text-sm text-slate-500">Kelola akses administrator untuk tim Anda.</p>
    </div>
    <a href="{{ route('admin.admins.create') }}" class="inline-flex items-center gap-2 px-4 py-2 rounded-xl bg-brand-600 text-white text-sm font-semibold hover:bg-brand-700 transition-colors">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
        </svg>
        Tambah Admin
    </a>
</div>

@if (session('success'))
    <div class="mb-4 p-4 bg-brand-100 text-brand-900 rounded-xl border border-brand-200">
        {{ session('success') }}
    </div>
@endif

<div class="glassmorphism rounded-3xl shadow-sm overflow-hidden">
    <table class="min-w-full text-left text-sm divide-y divide-brand-200/50">
        <thead class="bg-emerald-50/50 text-slate-800 border-b border-brand-200/50">
            <tr>
                <th class="px-6 py-3 font-semibold">Nama</th>
                <th class="px-6 py-3 font-semibold">Email</th>
                <th class="px-6 py-3 font-semibold">Telepon</th>
                <th class="px-6 py-3 font-semibold">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-brand-100/40">
            @forelse($admins as $admin)
            <tr class="hover:bg-emerald-50/30">
                <td class="px-6 py-4 text-slate-700 font-semibold">{{ $admin->name }}</td>
                <td class="px-6 py-4 text-slate-500">{{ $admin->email }}</td>
                <td class="px-6 py-4 text-slate-500">{{ $admin->phone ?? '-' }}</td>
                <td class="px-6 py-4 space-x-3">
                    <a href="{{ route('admin.admins.edit', $admin->id) }}" class="text-brand-700 hover:text-brand-600 font-semibold">Edit</a>
                    <form action="{{ route('admin.admins.destroy', $admin->id) }}" method="POST" class="inline-block" onsubmit="return confirm('Hapus admin ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-600 hover:text-red-700 font-semibold">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="px-6 py-8 text-center text-slate-500">Belum ada admin terdaftar.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Pagination -->
@if ($admins->hasPages())
    <div class="mt-6">
        {{ $admins->links() }}
    </div>
@endif
@endsection

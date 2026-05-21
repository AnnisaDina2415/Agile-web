@extends('admin.layouts.app')

@section('title', 'Kelola Pengguna')
@section('page-title', 'Kelola Pengguna')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <p class="text-sm text-slate-500">Kelola status pengguna terdaftar di platform Anda.</p>
    </div>
</div>

@if (session('success'))
    <div class="mb-4 p-4 bg-green-50 text-green-700 rounded-lg border border-green-200">
        {{ session('success') }}
    </div>
@endif

<div class="bg-white rounded-2xl border border-slate-100 shadow-sm overflow-hidden">
    <table class="min-w-full text-left text-sm divide-y divide-slate-200">
        <thead class="bg-slate-50 text-slate-600">
            <tr>
                <th class="px-6 py-3 font-semibold">Nama</th>
                <th class="px-6 py-3 font-semibold">Email</th>
                <th class="px-6 py-3 font-semibold">Telepon</th>
                <th class="px-6 py-3 font-semibold">Status</th>
                <th class="px-6 py-3 font-semibold">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-100 bg-white">
            @forelse($users as $user)
            <tr>
                <td class="px-6 py-4 text-slate-700 font-medium">{{ $user->name }}</td>
                <td class="px-6 py-4 text-slate-500">{{ $user->email }}</td>
                <td class="px-6 py-4 text-slate-500">{{ $user->phone ?? '-' }}</td>
                <td class="px-6 py-4">
                    <span class="inline-flex items-center rounded-full px-3 py-1 text-[11px] font-semibold {{ $user->is_active ? 'bg-green-50 text-green-600' : 'bg-red-50 text-red-600' }}">
                        {{ $user->is_active ? '✓ Aktif' : '✗ Non-Aktif' }}
                    </span>
                </td>
                <td class="px-6 py-4 text-right">
                    <form action="{{ route('admin.users.toggle-status', $user) }}" method="POST" class="inline-block" onsubmit="return confirm('Ubah status pengguna ini?');">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="px-3 py-1 text-sm rounded-lg font-semibold transition-colors {{ $user->is_active ? 'bg-red-100 text-red-600 hover:bg-red-200' : 'bg-green-100 text-green-600 hover:bg-green-200' }}">
                            {{ $user->is_active ? 'Non-Aktifkan' : 'Aktifkan' }}
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-6 py-8 text-center text-slate-500">Belum ada pengguna.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>

<!-- Pagination -->
@if ($users->hasPages())
    <div class="mt-6">
        {{ $users->links() }}
    </div>
@endif
@endsection

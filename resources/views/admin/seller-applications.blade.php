@extends('admin.layouts.app')

@section('title', 'Pengajuan Penjual')
@section('page-title', 'Pengajuan Penjual')

@section('content')
<div class="flex items-center justify-between mb-6">
    <div>
        <p class="text-sm text-slate-500">Review dan setujui pengajuan akun penjual dari pembeli.</p>
    </div>
</div>

@if (session('success'))
    <div class="mb-4 p-4 bg-brand-100 text-brand-900 rounded-xl border border-brand-200">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="mb-4 p-4 bg-red-50 text-red-700 rounded-xl border border-red-200">
        {{ session('error') }}
    </div>
@endif

<div class="grid gap-4">
    @forelse($applications as $app)
        <div class="glassmorphism rounded-3xl shadow-sm overflow-hidden">
            <div class="p-6">
                <!-- Header with Status -->
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-4">
                    <div>
                        <h2 class="text-lg font-bold text-slate-800">{{ $app->user->name }}</h2>
                        <p class="text-slate-500 text-sm">{{ $app->user->email }}</p>
                        <p class="text-slate-400 text-sm mt-1">Diajukan: {{ $app->created_at->format('d M Y H:i') }}</p>
                    </div>
                    <span class="inline-flex items-center rounded-full px-3 py-1 text-[11px] font-semibold
                        {{ $app->status === 'pending' ? 'bg-yellow-50 text-yellow-600' : '' }}
                        {{ $app->status === 'approved' ? 'bg-brand-100 text-brand-800' : '' }}
                        {{ $app->status === 'rejected' ? 'bg-red-50 text-red-600' : '' }}">
                        {{ $app->status === 'pending' ? 'Menunggu' : ($app->status === 'approved' ? 'Disetujui' : 'Ditolak') }}
                    </span>
                </div>

                <!-- KTP Image -->
                <div class="mb-4">
                    <p class="text-slate-700 font-semibold text-sm mb-2">Foto KTP:</p>
                    <img src="{{ asset('storage/' . $app->ktp_image) }}" alt="KTP" class="max-w-xs rounded-xl border border-emerald-300 shadow-sm">
                </div>

                <!-- Rejection Reason (if rejected) -->
                @if ($app->isRejected())
                    <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-xl">
                        <p class="text-red-700 font-semibold text-sm mb-1">Alasan Penolakan:</p>
                        <p class="text-red-600 text-sm">{{ $app->rejection_reason }}</p>
                    </div>
                @endif

                <!-- Actions -->
                @if ($app->isPending())
                    <div class="flex gap-3">
                        <form action="{{ route('admin.seller-applications.approve', $app) }}" method="POST" class="inline">
                            @csrf
                            @method('PATCH')
                            <button type="submit" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-brand-600 hover:bg-brand-700 text-white text-sm font-semibold transition-colors"
                                onclick="return confirm('Setujui pengajuan penjual ini?')">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                </svg>
                                Setujui
                            </button>
                        </form>

                        <button type="button" onclick="showRejectModal({{ $app->id }})" class="inline-flex items-center gap-2 px-4 py-2.5 rounded-xl bg-red-500 hover:bg-red-600 text-white text-sm font-semibold transition-colors">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            Tolak
                        </button>
                    </div>
                @endif
            </div>
        </div>
    @empty
        <div class="glassmorphism rounded-3xl shadow-sm p-8 text-center">
            <p class="text-slate-500 text-sm">Belum ada pengajuan penjual.</p>
        </div>
    @endforelse
</div>

<!-- Pagination -->
@if ($applications->hasPages())
    <div class="mt-6">
        {{ $applications->links() }}
    </div>
@endif

<!-- Reject Modal -->
<div id="rejectModal" class="hidden fixed inset-0 bg-black/50 backdrop-blur-sm flex items-center justify-center p-4 z-50">
    <div class="glassmorphism rounded-3xl p-6 max-w-md w-full shadow-lg">
        <h3 class="text-lg font-bold text-slate-800 mb-4">Alasan Penolakan</h3>
        <form id="rejectForm" method="POST">
            @csrf
            @method('PATCH')
            <textarea name="rejection_reason" required rows="4"
                class="w-full bg-emerald-50/60 border border-emerald-300 rounded-xl px-3 py-2 text-sm focus:outline-none focus:ring-2 focus:ring-brand-500 mb-4"
                placeholder="Jelaskan alasan penolakan..."></textarea>
            <div class="flex gap-3">
                <button type="submit" class="flex-1 bg-red-500 hover:bg-red-600 text-white px-4 py-2.5 rounded-xl font-semibold text-sm transition-colors">
                    Tolak
                </button>
                <button type="button" onclick="closeRejectModal()" class="flex-1 bg-emerald-50 hover:bg-emerald-100 text-emerald-800 px-4 py-2.5 rounded-xl font-semibold text-sm transition-colors border border-emerald-300">
                    Batal
                </button>
            </div>
        </form>
    </div>
</div>

<script>
function showRejectModal(applicationId) {
    const form = document.getElementById('rejectForm');
    form.action = `/admin/seller-applications/${applicationId}/reject`;
    document.getElementById('rejectModal').classList.remove('hidden');
}

function closeRejectModal() {
    document.getElementById('rejectModal').classList.add('hidden');
    document.getElementById('rejectForm').reset();
}
</script>

@endsection

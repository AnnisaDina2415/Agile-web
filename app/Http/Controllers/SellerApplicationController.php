<?php

namespace App\Http\Controllers;

use App\Models\SellerApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SellerApplicationController extends Controller
{
    public function index()
    {
        $applications = SellerApplication::with('user')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        return view('admin.seller-applications', compact('applications'));
    }

    public function approve(SellerApplication $application)
    {
        if ($application->status !== 'pending') {
            return back()->with('error', 'Hanya pengajuan pending yang bisa disetujui');
        }

        $application->update(['status' => 'approved']);

        // Create set_role entry for penjual
        $sellerRoleId = DB::table('roles')->where('role_name', 'penjual')->value('id');
        
        // Check if user already has seller role
        $existingRole = DB::table('set_roles')
            ->where('user_id', $application->user_id)
            ->where('role_id', $sellerRoleId)
            ->first();

        if (!$existingRole) {
            DB::table('set_roles')->insert([
                'user_id' => $application->user_id,
                'role_id' => $sellerRoleId,
            ]);
        }

        return redirect()->route('admin.seller-applications.index')
            ->with('success', 'Pengajuan berhasil disetujui. User sekarang memiliki role penjual');
    }

    public function reject(Request $request, SellerApplication $application)
    {
        $validated = $request->validate([
            'rejection_reason' => 'required|string|max:255',
        ]);

        if ($application->status !== 'pending') {
            return back()->with('error', 'Hanya pengajuan pending yang bisa ditolak');
        }

        $application->update([
            'status' => 'rejected',
            'rejection_reason' => $validated['rejection_reason'],
        ]);

        return redirect()->route('admin.seller-applications.index')
            ->with('success', 'Pengajuan berhasil ditolak');
    }
}

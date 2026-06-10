<?php

namespace App\Http\Controllers\Pembeli;

use App\Http\Controllers\Controller;
use App\Models\SellerApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        
        // Get user's roles
        $roles = DB::table('set_roles')
            ->join('roles', 'set_roles.role_id', '=', 'roles.id')
            ->where('set_roles.user_id', $user->id)
            ->pluck('roles.role_name')
            ->toArray();

        $isSellerRoleExists = in_array('penjual', $roles);
        $sellerApplication = SellerApplication::where('user_id', $user->id)->first();

        return view('pembeli.profile', compact('user', 'isSellerRoleExists', 'sellerApplication'));
    }

    public function edit()
    {
        return view('pembeli.profile-edit', ['user' => Auth::user()]);
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        $user = Auth::user();
        
        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
        ];

        if (!empty($validated['password'])) {
            $data['password'] = \Illuminate\Support\Facades\Hash::make($validated['password']);
        }

        $user->update($data);

        return redirect()->route('pembeli.profile.show')->with('success', 'Profil berhasil diperbarui');
    }

    public function uploadKTP(Request $request)
    {
        $validated = $request->validate([
            'ktp_image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Check if user already has application
        $existingApp = SellerApplication::where('user_id', Auth::id())->first();

        if ($existingApp && $existingApp->isPending()) {
            return back()->with('error', 'Anda sudah memiliki pengajuan yang sedang ditinjau');
        }

        $path = $request->file('ktp_image')->store('ktp-uploads', 'public');

        SellerApplication::updateOrCreate(
            ['user_id' => Auth::id()],
            [
                'ktp_image' => $path,
                'status' => 'pending',
                'rejection_reason' => null,
            ]
        );

        return redirect()->route('pembeli.profile.show')->with('success', 'KTP berhasil diunggah. Silahkan menunggu persetujuan admin');
    }
}

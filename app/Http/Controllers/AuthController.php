<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function showLogin(Request $request)
    {
        $selectedRole = $request->query('role', 'pembeli');
        return view('login', compact('selectedRole'));
    }

    public function login(Request $request)
    {
        // 🔐 Validasi input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'role' => 'required|in:pembeli,penjual,admin',
        ]);

        $credentials = $request->only('email', 'password');
        $remember = $request->has('remember');

        // Jika login sebagai admin
        if ($request->role === 'admin') {
            $admin = \App\Models\Admin::where('email', $request->email)->first();
            if ($admin && \Illuminate\Support\Facades\Hash::check($request->password, $admin->password)) {
                Auth::guard('admin')->login($admin, $remember);
                $request->session()->regenerate();
                return redirect()->route('admin.dashboard');
            }

            return back()->withErrors([
                'email' => 'Email atau password Admin salah'
            ])->onlyInput('email');
        }

        // Jika login sebagai pembeli atau penjual
        if (Auth::attempt($credentials, $remember)) {
            // 🔒 keamanan session
            $request->session()->regenerate();

            // 🚫 cek akun aktif
            if (!Auth::user()->is_active) {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Akun Anda dinonaktifkan oleh admin'
                ])->onlyInput('email');
            }

            $user = Auth::user();
            $userRoles = DB::table('set_roles')
                ->join('roles', 'set_roles.role_id', '=', 'roles.id')
                ->where('set_roles.user_id', $user->id)
                ->pluck('roles.role_name')
                ->toArray();

            // Cek role Penjual
            if ($request->role === 'penjual') {
                if (!in_array('penjual', $userRoles)) {
                    Auth::logout();
                    return back()->withErrors([
                        'email' => 'Akun Anda belum disetujui / terdaftar sebagai Penjual'
                    ])->onlyInput('email');
                }
                return redirect()->route('penjual.dashboard');
            }

            // Cek role Pembeli
            if (!in_array('pembeli', $userRoles)) {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Akun Anda tidak memiliki akses sebagai Pembeli'
                ])->onlyInput('email');
            }

            return redirect()->route('pembeli.dashboard');
        }

        // ❌ login gagal
        return back()->withErrors([
            'email' => 'Email atau password salah'
        ])->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        // 🔒 hapus session
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function showRegister(Request $request)
    {
        $selectedRole = $request->query('role', 'pembeli');
        return view('register', compact('selectedRole'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'nullable|string|max:20',
            'address' => 'nullable|string|max:255',
            'role' => 'required|in:pembeli,penjual',
        ]);

        $user = \App\Models\User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
            'phone' => $request->phone,
            'address' => $request->address,
            'is_active' => true,
        ]);

        $buyerRoleId = DB::table('roles')->where('role_name', 'pembeli')->value('id');
        $sellerRoleId = DB::table('roles')->where('role_name', 'penjual')->value('id');

        if ($request->role === 'penjual') {
            if ($buyerRoleId) {
                DB::table('set_roles')->insert([
                    'user_id' => $user->id,
                    'role_id' => $buyerRoleId,
                ]);
            }
            if ($sellerRoleId) {
                DB::table('set_roles')->insert([
                    'user_id' => $user->id,
                    'role_id' => $sellerRoleId,
                ]);
            }
        } else {
            if ($buyerRoleId) {
                DB::table('set_roles')->insert([
                    'user_id' => $user->id,
                    'role_id' => $buyerRoleId,
                ]);
            }
        }

        return redirect()->route('login')->with('success', 'Pendaftaran berhasil! Silakan masuk.');
    }

    public function showForgotPassword()
    {
        return view('forgot-password');
    }

    public function forgotPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'phone' => 'required|string',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = \App\Models\User::where('email', $request->email)
            ->where('phone', $request->phone)
            ->first();

        if (!$user) {
            return back()->withErrors([
                'email' => 'Email atau Nomor Telepon tidak cocok dengan akun manapun.'
            ])->onlyInput('email');
        }

        $user->update([
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Kata sandi berhasil diperbarui! Silakan masuk dengan kata sandi baru Anda.');
    }
}
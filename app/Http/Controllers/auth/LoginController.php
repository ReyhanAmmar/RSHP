<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function proses(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ], [
            'email.required' => 'Email wajib diisi',
            'email.email' => 'Format email tidak valid',
            'password.required' => 'Password wajib diisi',
        ]);

        $user = DB::table('user')->where('email', $request->email)->first();

        if (!$user) {
            return back()->with('error', 'Email tidak ditemukan');
        }

        if (!Hash::check($request->password, $user->password)) {
            return back()->with('error', 'Password salah');
        }

        $roleUser = DB::table('role_user')
            ->join('role', 'role_user.idrole', '=', 'role.idrole')
            ->where('role_user.iduser', $user->iduser)
            ->select('role.idrole', 'role.nama_role')
            ->first();

        // Simpan sesi user
        Session::put('iduser', $user->iduser);
        Session::put('nama', $user->nama);
        Session::put('role', $roleUser ? $roleUser->nama_role : 'Tidak ada role');

        // Arahkan sementara ke dashboard admin
        return redirect()->route('dashboard.admin')
            ->with('success', 'Selamat datang ' . $user->nama);
    }

    // Logout
    public function logout()
    {
        Session::flush();
        return redirect()->route('login')->with('success', 'Anda telah logout');
    }
}

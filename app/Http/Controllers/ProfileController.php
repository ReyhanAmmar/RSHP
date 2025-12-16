<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        $user = User::with(['roleUser.role', 'dokter', 'perawat', 'pemilik'])->find(Auth::id());
        return view('auth.profile', compact('user'));
    }

    public function update(Request $request)
    {
        $user = User::find(Auth::id());

        $request->validate([
            'nama'              => 'required|string|max:255',
            'email'             => 'required|email|max:255|unique:users,email,'.$user->iduser.',iduser',
            'foto'              => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'no_hp'             => 'nullable|numeric',
            'alamat'            => 'nullable|string|max:500',
            'jenis_kelamin'     => 'nullable|in:L,P',
            'bidang_dokter'     => 'nullable|string|max:100',
            'pendidikan'        => 'nullable|string|max:100', 
            'current_password'  => 'nullable|required_with:password',
            'password'          => 'nullable|min:6|confirmed',
        ]);

        if ($request->hasFile('foto')) {
            if ($user->foto && Storage::exists('public/' . $user->foto)) {
                Storage::delete('public/' . $user->foto);
            }
            $path = $request->file('foto')->store('photos', 'public');
            $user->foto = $path;
        }

        if ($request->filled('password')) {
            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Password saat ini salah.']);
            }
            $user->password = Hash::make($request->password);
            
            if(!$request->filled('nama')) {
                $user->save();
                return back()->with('success', 'Password berhasil diperbarui.');
            }
        }

        if ($request->filled('nama')) {
            $user->nama = $request->nama;
            $user->email = $request->email;
            $user->save();
        }

        if ($user->dokter) {
            $user->dokter->update([
                'no_hp'         => $request->no_hp,
                'alamat'        => $request->alamat,
                'jenis_kelamin' => $request->jenis_kelamin,
                'bidang_dokter' => $request->bidang_dokter,
            ]);
        } 
        
        elseif ($user->perawat) {
            $user->perawat->update([
                'no_hp'         => $request->no_hp,
                'alamat'        => $request->alamat,
                'jenis_kelamin' => $request->jenis_kelamin,
                'pendidikan'    => $request->pendidikan,
            ]);
        } 
        
        elseif ($user->pemilik) {
            $user->pemilik->update([
                'no_wa'  => $request->no_hp,
                'alamat' => $request->alamat
            ]);
        }

        return back()->with('success', 'Profil berhasil diperbarui.');
    }
}
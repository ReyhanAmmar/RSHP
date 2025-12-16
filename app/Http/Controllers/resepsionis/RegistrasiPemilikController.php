<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Pemilik;
use App\Models\RoleUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class RegistrasiPemilikController extends Controller
{
    public function index()
    {
        $pemilik = Pemilik::with('user')->orderBy('idpemilik', 'desc')->get();
        
        return view('resepsionis.registrasi-pemilik.index', compact('pemilik'));
    }

    public function create()
    {
        return view('resepsionis.registrasi-pemilik.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email|unique:user,email',
            'password' => 'required|min:6',
            'no_wa' => 'required|numeric',
            'alamat' => 'required|string',
        ]);

        DB::transaction(function () use ($request) {
            
            $user = User::create([
                'nama' => $request->nama, 
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            RoleUser::create([
                'iduser' => $user->iduser,
                'idrole' => 5, 
                'status' => 1
            ]);

            Pemilik::create([
                'iduser' => $user->iduser,
                'no_wa' => $request->no_wa,
                'alamat' => $request->alamat,
            ]);
        });

        return redirect()->route('resepsionis.registrasi-pemilik.index')
                         ->with('success', 'Pemilik berhasil didaftarkan!');
    }

    public function edit($id)
    {
        $pemilik = Pemilik::with('user')->findOrFail($id);
        return view('resepsionis.registrasi-pemilik.edit', compact('pemilik'));
    }

    public function update(Request $request, $id)
    {
        $pemilik = Pemilik::findOrFail($id);
        $user = User::findOrFail($pemilik->iduser);

        $request->validate([
            'nama' => 'required|string|max:100',
            'email' => 'required|email|unique:user,email,'.$user->iduser.',iduser',
            'no_wa' => 'required|numeric',
            'alamat' => 'required|string',
        ]);

        $user->update([
            'nama' => $request->nama,
            'email' => $request->email,
        ]);

        if ($request->filled('password')) {
            $user->update(['password' => Hash::make($request->password)]);
        }

        $pemilik->update([
            'no_wa' => $request->no_wa,
            'alamat' => $request->alamat,
        ]);

        return redirect()->route('resepsionis.registrasi-pemilik.index')
                         ->with('success', 'Data pemilik berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pemilik = Pemilik::findOrFail($id);
        $user = User::find($pemilik->iduser);

        if ($user) {
            RoleUser::where('iduser', $user->iduser)->delete();
            $pemilik->delete();
            $user->delete();
        }

        return redirect()->route('resepsionis.registrasi-pemilik.index')
                         ->with('success', 'Pemilik berhasil dihapus.');
    }
}
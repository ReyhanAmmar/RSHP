<?php

namespace App\Http\Controllers\resepsionis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemilik;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class RegistrasiPemilikController extends Controller
{
    public function create()
    {
        $users = User::all();
        return view('resepsionis.registrasi-pemilik.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'iduser' => 'required|exists:user,iduser',
            'no_wa' => 'required',
            'alamat' => 'required',
        ]);

        Pemilik::create($request->only('iduser', 'no_wa', 'alamat'));

        return redirect()->route('resepsionis.registrasi-pemilik.create')->with('success', 'Data Pemilik berhasil ditambahkan!');
    }
}

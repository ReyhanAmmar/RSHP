<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\Pemilik;
use App\Models\JenisHewan;
use App\Models\RasHewan;

class RegistrasiPetController extends Controller
{
    public function create()
    {
        $pemilik = Pemilik::with('user')->get();
        
        $jenisHewan = JenisHewan::all();
        $rasHewan = RasHewan::all();

        return view('resepsionis.registrasi-pet.create', compact('pemilik', 'jenisHewan', 'rasHewan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'idpemilik' => 'required|exists:pemilik,idpemilik', 
            'nama' => 'required|string|max:100',
            'idjenis_hewan' => 'required|exists:jenis_hewan,idjenis_hewan', 
            'idras_hewan' => 'required|exists:ras_hewan,idras_hewan',
            'jenis_kelamin' => 'required|in:J,B',
            'warna_tanda' => 'required|string|max:50',
            'tanggal_lahir' => 'nullable|date',
        ]);

        Pet::create([
            'idpemilik' => $request->idpemilik,
            'nama' => $request->nama,
            'idras_hewan' => $request->idras_hewan,
            'jenis_kelamin' => $request->jenis_kelamin,
            'warna_tanda' => $request->warna_tanda,
            'tanggal_lahir' => $request->tanggal_lahir,
        ]);

        return redirect()->route('resepsionis.dashboard')
                         ->with('success', 'Data Hewan berhasil ditambahkan ke database!');
    }
}
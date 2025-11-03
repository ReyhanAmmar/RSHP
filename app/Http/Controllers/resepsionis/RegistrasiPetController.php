<?php

namespace App\Http\Controllers\resepsionis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pemilik;
use App\Models\Pet;
use Illuminate\Support\Facades\DB;

class RegistrasiPetController extends Controller
{
    public function create()
    {
        $pemilik = Pemilik::all();
        $jenisHewan = DB::table('jenis_hewan')->get();
        return view('resepsionis.registrasi-pet.create', compact('pemilik', 'jenisHewan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'tanggal_lahir' => 'required|date',
            'warna_tanda' => 'required',
            'jenis_kelamin' => 'required',
            'idpemilik' => 'required|exists:pemilik,idpemilik',
            'idjenis_hewan' => 'required|exists:jenis_hewan,idjenis_hewan',
        ]);

        Pet::create($request->all());

        return redirect()->route('resepsionis.dashboard-resepsionis')->with('success', 'Data Pet berhasil ditambahkan!');
    }
}

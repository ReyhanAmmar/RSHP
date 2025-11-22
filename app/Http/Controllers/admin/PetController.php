<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pet;
use App\Models\Pemilik;
use App\Models\JenisHewan;
use App\Models\RasHewan;

class PetController extends Controller
{
    public function index()
    {
        $pets = Pet::with(['pemilik.user', 'rasHewan.jenisHewan'])
                   ->orderBy('idpet', 'desc')
                   ->get();

        return view('admin.data-pet.index', compact('pets'));
    }

    public function create()
    {
        $pemilik = Pemilik::with('user')->get();
        $jenisHewan = JenisHewan::all();
        $rasHewan = RasHewan::all();

        return view('admin.data-pet.create', compact('pemilik', 'jenisHewan', 'rasHewan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'idpemilik' => 'required|exists:pemilik,idpemilik',
            'idjenis_hewan' => 'required|exists:jenis_hewan,idjenis_hewan',
            'idras_hewan' => 'required|exists:ras_hewan,idras_hewan',
            'jenis_kelamin' => 'required|in:J,B',
            'warna_tanda' => 'required|string|max:50',
            'tanggal_lahir' => 'nullable|date',
        ]);

        Pet::create([
            'nama' => $request->nama,
            'idpemilik' => $request->idpemilik,
            'idras_hewan' => $request->idras_hewan,
            'jenis_kelamin' => $request->jenis_kelamin,
            'warna_tanda' => $request->warna_tanda,
            'tanggal_lahir' => $request->tanggal_lahir,
        ]);

        return redirect()->route('admin.data-pet.index')->with('success', 'Data Hewan berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $pet = Pet::with('rasHewan')->findOrFail($id);
        
        $pemilik = Pemilik::with('user')->get();
        $jenisHewan = JenisHewan::all();
        $rasHewan = RasHewan::all();
        
        $currentJenisId = $pet->rasHewan->idjenis_hewan ?? null;

        return view('admin.data-pet.edit', compact('pet', 'pemilik', 'jenisHewan', 'rasHewan', 'currentJenisId'));
    }

    public function update(Request $request, $id)
    {
        $pet = Pet::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:100',
            'idpemilik' => 'required|exists:pemilik,idpemilik',
            'idras_hewan' => 'required|exists:ras_hewan,idras_hewan',
            'jenis_kelamin' => 'required|in:J,B',
            'warna_tanda' => 'required|string|max:50',
            'tanggal_lahir' => 'nullable|date',
        ]);

        $pet->update([
            'nama' => $request->nama,
            'idpemilik' => $request->idpemilik,
            'idras_hewan' => $request->idras_hewan,
            'jenis_kelamin' => $request->jenis_kelamin,
            'warna_tanda' => $request->warna_tanda,
            'tanggal_lahir' => $request->tanggal_lahir,
        ]);

        return redirect()->route('admin.data-pet.index')->with('success', 'Data Hewan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $pet = Pet::findOrFail($id);
        $pet->delete();

        return redirect()->route('admin.data-pet.index')->with('success', 'Data Hewan berhasil dihapus.');
    }
}
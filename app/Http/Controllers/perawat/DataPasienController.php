<?php

namespace App\Http\Controllers\perawat;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use Illuminate\Http\Request;

class DataPasienController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('status', 'aktif');

        $query = Pet::with(['pemilik.user', 'rasHewan', 'jenisHewan']);

        if ($status === 'non-aktif') {
            $query->onlyTrashed();
        }

        $pets = $query->latest('idpet')->get();

        return view('perawat.data-pasien.index', compact('pets', 'status'));
    }

    public function show($id)
    {
        $pet = Pet::withTrashed()
                ->with(['pemilik.user', 'rasHewan', 'rekamMedis.dokter.user'])
                ->findOrFail($id);

        return view('perawat.data-pasien.show', compact('pet'));
    }
}
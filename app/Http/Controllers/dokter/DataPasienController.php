<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\Pet;
use Illuminate\Http\Request;

class DataPasienController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('status', 'aktif');

        $query = Pet::with(['pemilik.user', 'rasHewan', 'jenisHewan']);

        if ($status === 'Non-Aktif') {
            $query->onlyTrashed();
        }

        $pets = $query->latest('idpet')->get();

        return view('dokter.data-pasien.index', compact('pets', 'status'));
    }

    public function show($id)
    {
        $pet = Pet::withTrashed()
                ->with(['pemilik.user', 'rasHewan', 'rekamMedis.dokter.user', 'jenisHewan'])
                ->findOrFail($id);

        return view('dokter.data-pasien.show', compact('pet'));
    }
}

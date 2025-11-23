<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\RekamMedis;

class DokterController extends Controller
{
    public function index()
    {
        $rekamMedis = RekamMedis::with(['pet.pemilik.user', 'detailRekamMedis'])
                        ->orderBy('created_at', 'desc')
                        ->get();

        return view('dokter.rekam-medis.index', compact('rekamMedis'));
    }

    public function show($id)
    {
        $rm = RekamMedis::with(['pet.pemilik.user', 'detailRekamMedis.kodeTindakan', 'temuDokter'])->findOrFail($id);
        return view('dokter.rekam-medis.show', compact('rm'));
    }
}
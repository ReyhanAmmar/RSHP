<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\RekamMedis;
use App\Models\DetailRekamMedis;
use App\Models\Kategori;
use App\Models\KategoriKlinis;
use App\Models\TemuDokter;
use App\Models\KodeTindakanTerapi;

class DokterController extends Controller
{
    public function index()
    {
        $rekamMedis = RekamMedis::where('dokter_pemeriksa', auth()->user()->iduser)
                        ->with(['pet.pemilik.user'])
                        ->get();
                        
        return view('dokter.rekam-medis.index', compact('rekamMedis'));
    }

    public function show($id)
    {
        $rekamMedis = RekamMedis::with(['pet.pemilik.user', 'detailRekamMedis.tindakan'])->findOrFail($id);
        $tindakan = KodeTindakanTerapi::all();
        
        return view('dokter.rekam-medis.show', compact('rekamMedis', 'tindakan'));
    }

    public function create($idreservasi)
    {
        $reservasi = TemuDokter::with(['pet.pemilik.user', 'roleUser.user'])->findOrFail($idreservasi);
        
        $existing = RekamMedis::where('idreservasi_dokter', $idreservasi)->first();
        if ($existing) {
            return redirect()->route('perawat.rekam-medis.edit', $existing->idrekam_medis)
                             ->with('info', 'Rekam medis sudah ada, silakan lanjutkan pengisian tindakan.');
        }

        return view('perawat.rekam-medis.create', compact('reservasi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'anamnesa' => 'required',
            'diagnosa' => 'required',
        ]);

        $rm = RekamMedis::create([
            'idreservasi_dokter' => $request->idreservasi_dokter,
            'idpet' => $request->idpet,
            'dokter_pemeriksa' => $request->dokter_pemeriksa,
            'anamnesa' => $request->anamnesa,
            'temuan_klinis' => $request->temuan_klinis,
            'diagnosa' => $request->diagnosa,
        ]);

        TemuDokter::where('idreservasi_dokter', $request->idreservasi_dokter)->update(['status' => '1']);

        return redirect()->route('perawat.rekam-medis.edit', $rm->idrekam_medis)
                         ->with('success', 'Data awal tersimpan. Silakan input tindakan terapi.');
    }

    public function edit($id)
    {
        $rekamMedis = RekamMedis::with(['pet.pemilik.user', 'detailRekamMedis.kodeTindakan', 'temuDokter.roleUser.user'])->findOrFail($id);
        
        $kategori = Kategori::all();
        $kategoriKlinis = KategoriKlinis::all();
        
        $listTindakan = KodeTindakanTerapi::all();

        return view('perawat.rekam-medis.edit', compact('rekamMedis', 'listTindakan', 'kategori', 'kategoriKlinis'));
    }

    public function update(Request $request, $id)
    {
        $rm = RekamMedis::findOrFail($id);
        $rm->update($request->only(['anamnesa', 'temuan_klinis', 'diagnosa']));

        return back()->with('success', 'Data pemeriksaan diperbarui.');
    }

    public function storeDetail(Request $request, $id)
    {
        $request->validate([
            'idkode_tindakan_terapi' => 'required',
            'detail' => 'nullable|string'
        ]);

        DetailRekamMedis::create([
            'idrekam_medis' => $id,
            'idkode_tindakan_terapi' => $request->idkode_tindakan_terapi,
            'detail' => $request->detail,
        ]);

        return redirect()->back()->with('success', 'Tindakan berhasil ditambahkan.');
    }

    public function destroyDetail($id_detail)
    {
        $detail = DetailRekamMedis::findOrFail($id_detail);
        $detail->delete();

        return redirect()->back()->with('success', 'Item tindakan dihapus.');
    }

    public function updateDiagnosa(Request $request, $id)
    {
        $rm = RekamMedis::findOrFail($id);
        $rm->update([
            'anamnesa' => $request->anamnesa,
            'diagnosa' => $request->diagnosa,
            'temuan_klinis' => $request->temuan_klinis,
        ]);
        return redirect()->back()->with('success', 'Data medis berhasil diupdate.');
    }
}
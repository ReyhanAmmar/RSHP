<?php

namespace App\Http\Controllers\Perawat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TemuDokter;
use App\Models\RekamMedis;
use App\Models\DetailRekamMedis;
use App\Models\KodeTindakanTerapi;
use App\Models\RoleUser;

class RekamMedisController extends Controller
{
    public function index()
    {
        $antrian = TemuDokter::with(['pet.pemilik.user', 'roleUser.user'])
                    ->where('status', '0') 
                    ->orderBy('waktu_daftar', 'asc')
                    ->orderBy('no_urut', 'asc')
                    ->get();

        return view('perawat.rekam-medis.index', compact('antrian'));
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
        $rekamMedis = RekamMedis::with(['pet', 'detailRekamMedis.kodeTindakan'])->findOrFail($id);
        
        $listTindakan = KodeTindakanTerapi::all();

        return view('perawat.rekam-medis.edit', compact('rekamMedis', 'listTindakan'));
    }

    public function update(Request $request, $id)
    {
        $rm = RekamMedis::findOrFail($id);
        $rm->update($request->only(['anamnesa', 'temuan_klinis', 'diagnosa']));

        return back()->with('success', 'Data pemeriksaan diperbarui.');
    }

    public function storeDetail(Request $request, $id)
    {
        $request->validate(['idkode_tindakan_terapi' => 'required']);

        DetailRekamMedis::create([
            'idrekam_medis' => $id,
            'idkode_tindakan_terapi' => $request->idkode_tindakan_terapi,
            'detail' => $request->detail
        ]);

        return back()->with('success', 'Tindakan berhasil ditambahkan.');
    }

    public function destroyDetail($id_detail)
    {
        DetailRekamMedis::destroy($id_detail);
        return back()->with('success', 'Tindakan dihapus.');
    }
}
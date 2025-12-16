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
    /**
     * Menampilkan daftar rekam medis pasien untuk dokter
     */
    public function index()
    {
        $rekamMedisList = RekamMedis::whereHas('dokter', function($query) {
                        $query->where('iduser', Auth::user()->iduser);
                    })
                    ->with(['pet.pemilik.user', 'pet.jenisHewan', 'pet.rasHewan', 'detailRekamMedis'])
                    ->latest('created_at')
                    ->get();
                    
        return view('dokter.rekam-medis.index', compact('rekamMedisList'));
    }

    /**
     * Menampilkan detail rekam medis dengan management detail tindakan
     */
    public function show($id)
    {
        $rekamMedis = RekamMedis::with([
            'pet.pemilik.user', 
            'pet.jenisHewan', 
            'pet.rasHewan',
            'dokter.user', 
            'detailRekamMedis.tindakan'
        ])->findOrFail($id);
        
        $tindakan = KodeTindakanTerapi::all();
        
        return view('dokter.rekam-medis.show', compact('rekamMedis', 'tindakan'));
    }

    /**
     * Form buat rekam medis dari antrian
     */
    public function create($idreservasi)
    {
        $reservasi = TemuDokter::with(['pet.pemilik.user', 'roleUser.user'])->findOrFail($idreservasi);
        
        $existing = RekamMedis::where('idreservasi_dokter', $idreservasi)->first();
        if ($existing) {
            return redirect()->route('dokter.rekam-medis.show', $existing->idrekam_medis)
                             ->with('info', 'Rekam medis sudah ada, silakan lanjutkan pengisian tindakan.');
        }

        return view('dokter.rekam-medis.create', compact('reservasi'));
    }

    /**
     * Menyimpan rekam medis baru
     */
    public function store(Request $request)
    {
        $request->validate([
            'idpet' => 'required|exists:pet,idpet',
            'anamnesa' => 'required',
            'diagnosa' => 'required',
            'idreservasi' => 'required'
        ]);

        $rm = RekamMedis::create([
            'idreservasi_dokter' => $request->idreservasi,
            'idpet' => $request->idpet,
            'iddokter' => Auth::user()->dokter->iddokter,
            'anamnesa' => $request->anamnesa,
            'temuan_klinis' => $request->temuan_klinis,
            'diagnosa' => $request->diagnosa,
            'suhu' => $request->suhu,
            'berat' => $request->berat,
        ]);

        TemuDokter::where('idreservasi_dokter', $request->idreservasi)->update(['status' => '1']);

        return redirect()->route('dokter.rekam-medis.show', $rm->idrekam_medis)
                         ->with('success', 'Data rekam medis berhasil dibuat. Silakan tambahkan detail tindakan.');
    }

    /**
     * Form edit rekam medis
     */
    public function edit($id)
    {
        $rekamMedis = RekamMedis::with(['pet.pemilik.user', 'detailRekamMedis.tindakan', 'dokter.user'])->findOrFail($id);
        
        $listTindakan = KodeTindakanTerapi::all();

        return view('dokter.rekam-medis.edit', compact('rekamMedis', 'listTindakan'));
    }

    /**
     * Update data rekam medis
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'anamnesa' => 'required',
            'diagnosa' => 'required',
        ]);

        $rm = RekamMedis::findOrFail($id);
        $rm->update([
            'anamnesa' => $request->anamnesa,
            'temuan_klinis' => $request->temuan_klinis,
            'diagnosa' => $request->diagnosa,
            'suhu' => $request->suhu,
            'berat' => $request->berat,
        ]);

        return back()->with('success', 'Data pemeriksaan berhasil diperbarui.');
    }

    /**
     * Tambah detail rekam medis (tindakan terapi)
     */
    public function storeDetail(Request $request, $id)
    {
        $request->validate([
            'idkode_tindakan_terapi' => 'required|exists:kode_tindakan_terapi,idkode_tindakan_terapi',
            'detail' => 'nullable|string'
        ]);

        DetailRekamMedis::create([
            'idrekam_medis' => $id,
            'idkode_tindakan_terapi' => $request->idkode_tindakan_terapi,
            'detail' => $request->detail,
        ]);

        return redirect()->back()->with('success', 'Tindakan terapi berhasil ditambahkan.');
    }

    /**
     * Hapus detail rekam medis
     */
    public function destroyDetail($id_detail)
    {
        $detail = DetailRekamMedis::findOrFail($id_detail);
        $detail->delete();

        return redirect()->back()->with('success', 'Tindakan terapi dihapus.');
    }

    /**
     * Update diagnosa
     */
    public function updateDiagnosa(Request $request, $id)
    {
        $rm = RekamMedis::findOrFail($id);
        $rm->update([
            'anamnesa' => $request->anamnesa,
            'diagnosa' => $request->diagnosa,
            'temuan_klinis' => $request->temuan_klinis,
        ]);
        return redirect()->back()->with('success', 'Data medis berhasil diperbarui.');
    }
}

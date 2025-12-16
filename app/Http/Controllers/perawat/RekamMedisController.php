<?php

namespace App\Http\Controllers\perawat;

use App\Http\Controllers\Controller;
use App\Models\RekamMedis;
use App\Models\DetailRekamMedis;
use App\Models\TemuDokter;
use App\Models\Dokter;
use App\Models\KodeTindakanTerapi;
use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RekamMedisController extends Controller
{
    public function index(Request $request)
    {
        // Fetch antrian (TemuDokter) yang masih menunggu atau sedang diproses
        $antrian = TemuDokter::with([
            'pet.pemilik.user',
            'pet.jenisHewan',
            'roleUser.user'
        ])->latest('waktu_daftar')->get();

        // Fetch rekam medis yang sudah dibuat (history)
        $rekamMedisHistory = RekamMedis::with([
            'pet.pemilik.user',
            'pet.jenisHewan',
            'dokter.user'
        ])->latest('created_at')->get();

        return view('perawat.rekam-medis.index', compact('antrian', 'rekamMedisHistory'));
    }

    /**
     * Form Buat Rekam Medis (Biasanya dari klik 'Proses' di daftar reservasi)
     * @param int $idreservasi ID dari tabel temu_dokter
     */
    public function create($idreservasi)
    {
        $reservasi = TemuDokter::with(['pet.pemilik.user', 'dokter.user'])->findOrFail($idreservasi);
        
        $dokters = Dokter::with('user')->get();

        return view('perawat.rekam-medis.create', compact('reservasi', 'dokters'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'idpet' => 'required|exists:pet,idpet',
            'idreservasi_dokter' => 'required',
            'anamnesa' => 'required|string',
            'temuan_klinis' => 'nullable|string',
            'diagnosa' => 'required|string'
        ]);

        $rekamMedis = null;
        DB::transaction(function () use ($request, &$rekamMedis) {
            $reservasi = TemuDokter::findOrFail($request->idreservasi_dokter);
            
            $rekamMedis = RekamMedis::create([
                'idpet' => $request->idpet,
                'idreservasi_dokter' => $request->idreservasi_dokter,
                'dokter_pemeriksa' => $reservasi->idrole_user,
                'anamnesa' => $request->anamnesa,
                'temuan_klinis' => $request->temuan_klinis,
                'diagnosa' => $request->diagnosa,
                'created_at' => now(),
            ]);

            $reservasi->update(['status' => '1']);
        });

        return redirect()->route('perawat.rekam-medis.tindakan', $rekamMedis->idrekam_medis)
                         ->with('success', 'Rekam Medis berhasil dibuat. Silakan tambahkan tindakan terapi.');
    }

    public function edit($id)
    {
        $rekamMedis = RekamMedis::with(['pet', 'dokter.user'])->findOrFail($id);
        $dokters = Dokter::with('user')->get();

        return view('perawat.rekam-medis.edit', compact('rekamMedis', 'dokters'));
    }

    /**
     * Menampilkan detail Rekam Medis dengan Tindakan Terapi
     */
    public function show($id)
    {
        $rekamMedis = RekamMedis::with([
            'pet.pemilik.user', 
            'pet.jenisHewan', 
            'pet.rasHewan', 
            'dokter.user',
            'detailRekamMedis.kodeTindakan'
        ])->findOrFail($id);

        $tindakan = KodeTindakanTerapi::all();

        return view('perawat.rekam-medis.show', compact('rekamMedis', 'tindakan'));
    }

    /**
     * Menampilkan halaman manajemen tindakan terapi untuk rekam medis
     */
    public function tindakan($id)
    {
        $rekamMedis = RekamMedis::with([
            'pet.pemilik.user', 
            'pet.jenisHewan',
            'detailRekamMedis.kodeTindakan'
        ])->findOrFail($id);

        $tindakan = KodeTindakanTerapi::all();

        return view('perawat.rekam-medis.tindakan', compact('rekamMedis', 'tindakan'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'anamnesa' => 'required|string',
            'temuan_klinis' => 'nullable|string',
            'diagnosa' => 'required|string',
        ]);

        $rekamMedis = RekamMedis::findOrFail($id);
        $rekamMedis->update([
            'anamnesa' => $request->anamnesa,
            'temuan_klinis' => $request->temuan_klinis,
            'diagnosa' => $request->diagnosa,
        ]);

        return redirect()->route('perawat.rekam-medis.index')->with('success', 'Data Rekam Medis berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $rm = RekamMedis::findOrFail($id);
        $rm->deleted_by = auth()->user()->iduser;
        $rm->save();
        $rm->delete();

        return redirect()->route('perawat.rekam-medis.index')->with('success', 'Rekam Medis dihapus.');
    }

    public function restore($id)
    {
        $rm = RekamMedis::onlyTrashed()->findOrFail($id);
        $rm->restore();

        return redirect()->route('perawat.rekam-medis.index', ['status' => 'Non-Aktif'])
            ->with('success', 'Rekam Medis dikembalikan.');
    }

    /**
     * Tambah detail tindakan terapi
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
     * Hapus detail tindakan terapi
     */
    public function destroyDetail($id_detail)
    {
        $detail = DetailRekamMedis::findOrFail($id_detail);
        $detail->delete();

        return redirect()->back()->with('success', 'Tindakan terapi dihapus.');
    }
}
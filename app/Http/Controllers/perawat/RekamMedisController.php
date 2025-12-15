<?php

namespace App\Http\Controllers\perawat;

use App\Http\Controllers\Controller;
use App\Models\RekamMedis;
use App\Models\TemuDokter;
use App\Models\Dokter;
use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RekamMedisController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('status', 'aktif');
        
        $query = RekamMedis::with(['pet.pemilik.user', 'dokter.user']);

        if ($status === 'non-aktif') {
            $query->onlyTrashed();
        }

        $rekamMedis = $query->latest('created_at')->get();

        return view('perawat.rekam-medis.index', compact('rekamMedis', 'status'));
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
            'dokter_pemeriksa' => 'required|exists:dokter,id_dokter',
            'suhu' => 'nullable|numeric',
            'berat' => 'nullable|numeric',
            'anamnesa' => 'required|string',
            'temuan_klinis' => 'nullable|string',
            'idreservasi' => 'required' 
        ]);

        DB::transaction(function () use ($request) {
            RekamMedis::create([
                'idpet' => $request->idpet,
                'dokter_pemeriksa' => $request->dokter_pemeriksa,
                'suhu' => $request->suhu,
                'berat' => $request->berat,
                'anamnesa' => $request->anamnesa,
                'temuan_klinis' => $request->temuan_klinis,
                'diagnosa' => null, 
                'created_at' => now(),
            ]);

            $reservasi = TemuDokter::findOrFail($request->idreservasi);
            $reservasi->update(['status' => 'Sedang Diperiksa']);
        });

        return redirect()->route('perawat.rekam-medis.index')->with('success', 'Rekam Medis berhasil dibuat. Silakan informasikan ke Dokter.');
    }

    public function edit($id)
    {
        $rekamMedis = RekamMedis::with(['pet', 'dokter.user'])->findOrFail($id);
        $dokters = Dokter::with('user')->get();

        return view('perawat.rekam-medis.edit', compact('rekamMedis', 'dokters'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'dokter_pemeriksa' => 'required',
            'anamnesa' => 'required',
            'suhu' => 'nullable|numeric',
            'berat' => 'nullable|numeric',
        ]);

        $rekamMedis = RekamMedis::findOrFail($id);
        $rekamMedis->update([
            'dokter_pemeriksa' => $request->dokter_pemeriksa,
            'anamnesa' => $request->anamnesa,
            'temuan_klinis' => $request->temuan_klinis,
            'suhu' => $request->suhu,
            'berat' => $request->berat,
        ]);

        return redirect()->route('perawat.rekam-medis.index')->with('success', 'Data Rekam Medis diperbarui.');
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

        return redirect()->route('perawat.rekam-medis.index', ['status' => 'non-aktif'])
            ->with('success', 'Rekam Medis dikembalikan.');
    }
}
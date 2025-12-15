<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\RekamMedis;
use Illuminate\Http\Request;

class DataRekamMedisController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('status', 'aktif');
        $query = RekamMedis::with(['pet', 'dokter.user']);

        if ($status === 'non-aktif') {
            $query->onlyTrashed();
        }

        $data = $query->latest()->get();
        return view('admin.rekam-medis.index', compact('data', 'status'));
    }

    public function show($id)
    {
        $rekamMedis = RekamMedis::with(['detailRekamMedis.tindakan'])->findOrFail($id);
        return view('admin.rekam-medis.show', compact('rekamMedis'));
    }

    public function destroy($id)
    {
        $rm = RekamMedis::findOrFail($id);
        $rm->delete();
        return redirect()->back()->with('success', 'Rekam medis dihapus.');
    }

    public function restore($id)
    {
        RekamMedis::onlyTrashed()->findOrFail($id)->restore();
        return redirect()->back()->with('success', 'Rekam medis dikembalikan.');
    }
}
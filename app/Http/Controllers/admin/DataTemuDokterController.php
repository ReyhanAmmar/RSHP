<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\TemuDokter;
use App\Models\Dokter;
use Illuminate\Http\Request;

class DataTemuDokterController extends Controller
{
    public function index(Request $request)
    {
        $status = $request->get('status', 'aktif');
        $query = TemuDokter::with(['pet.pemilik.user', 'dokter.user']); 

        if ($status === 'non-aktif') {
            $query->onlyTrashed();
        }

        $data = $query->orderBy('waktu_daftar', 'desc')->get();
        return view('admin.temu-dokter.index', compact('data', 'status'));
    }

    public function destroy($id)
    {
        $item = TemuDokter::findOrFail($id);
        $item->delete();
        return redirect()->back()->with('success', 'Reservasi dihapus.');
    }
    
    public function restore($id)
    {
        TemuDokter::onlyTrashed()->findOrFail($id)->restore();
        return redirect()->back()->with('success', 'Reservasi dikembalikan.');
    }
}
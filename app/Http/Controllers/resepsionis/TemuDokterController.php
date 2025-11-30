<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TemuDokter;
use App\Models\Pet;
use App\Models\Pemilik;
use App\Models\RoleUser;
use Carbon\Carbon;

class TemuDokterController extends Controller
{
    public function index()
    {
        $temuDokter = TemuDokter::with(['pet.pemilik', 'roleUser.user'])
            ->orderBy('waktu_daftar', 'desc')
            ->orderBy('no_urut', 'asc')
            ->get();

        return view('resepsionis.temu-dokter.index', compact('temuDokter'));
    }

    public function create()
    {
        $pets = Pet::all();
        $pemilik = Pemilik::with('user')->get(); 
        
        $dokter = RoleUser::whereHas('role', function ($q) {
            $q->where('nama_role', 'Dokter');
        })->with('user')->get();

        return view('resepsionis.temu-dokter.create', compact('pets', 'pemilik', 'dokter'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'idpet' => 'required|exists:pet,idpet',
            'idrole_user' => 'required|exists:role_user,idrole_user',
            'tanggal_temu' => 'required|date',
        ]);

        $tanggalDaftar = $request->tanggal_temu;
        
        $maxNoUrut = TemuDokter::whereDate('waktu_daftar', $tanggalDaftar)->max('no_urut');
        
        $noUrut = $maxNoUrut ? ($maxNoUrut + 1) : 1;

        TemuDokter::create([
            'no_urut' => $noUrut,
            'waktu_daftar' => $tanggalDaftar,
            'status' => '0',
            'idpet' => $request->idpet,
            'idrole_user' => $request->idrole_user,
        ]);

        return redirect()->route('temu-dokter.index')
                         ->with('success', 'Pendaftaran berhasil! Nomor Antrian: ' . $noUrut);
    }

    public function updateStatus(Request $request, $id)
    {
        $temuDokter = TemuDokter::findOrFail($id);
        $request->validate(['status' => 'required|in:0,1,2']);
        
        $temuDokter->update(['status' => $request->status]);

        return redirect()->route('temu-dokter.index')->with('success', 'Status berhasil diperbarui.');
    }
}
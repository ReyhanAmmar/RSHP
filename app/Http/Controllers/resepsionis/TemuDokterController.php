<?php

namespace App\Http\Controllers\Resepsionis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TemuDokter;
use App\Models\Pet;
use App\Models\RoleUser;

class TemuDokterController extends Controller
{
    public function create()
    {
        $pets = Pet::all();
        $dokters = RoleUser::whereHas('role', function ($q) {
            $q->where('nama_role', 'Dokter');
        })->with('user')->get();

        return view('resepsionis.temu-dokter', compact('pets', 'dokters'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'idpet' => 'required|exists:pet,idpet',
            'idrole_user' => 'required|exists:role_user,idrole_user',
        ]);

        $noUrut = TemuDokter::whereDate('waktu_daftar', now()->toDateString())->count() + 1;

        TemuDokter::create([
            'no_urut' => $noUrut,
            'waktu_daftar' => now(),
            'status' => '0',
            'idpet' => $request->idpet,
            'idrole_user' => $request->idrole_user,
        ]);

        return redirect()->route('resepsionis.home')->with('success', 'Temu Dokter berhasil didaftarkan!');
    }
}

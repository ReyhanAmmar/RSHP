<?php

namespace App\Http\Controllers\Pemilik;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Pemilik;
use App\Models\Pet;
use App\Models\TemuDokter;
use App\Models\RekamMedis;

class DashboardPemilikController extends Controller
{
    private function getPemilik()
    {
        $user = Auth::user();
        return Pemilik::where('iduser', $user->iduser)->first();
    }

    public function index()
    {
        $user = Auth::user();
        $pemilik = Pemilik::where('iduser', $user->iduser)->first();

        if (!$pemilik) {
            return view('pemilik.dashboard', [
                'totalHewan' => 0, 
                'reservasiAktif' => 0, 
                'totalPemeriksaan' => 0
            ]);
        }

        $totalHewan = Pet::where('idpemilik', $pemilik->idpemilik)->count();

        $petIds = Pet::where('idpemilik', $pemilik->idpemilik)->pluck('idpet');
        
        $reservasiAktif = TemuDokter::whereIn('idpet', $petIds)
                            ->where('status', '0')
                            ->count();

        $totalPemeriksaan = RekamMedis::whereIn('idpet', $petIds)->count();

        return view('pemilik.dashboard-pemilik', compact('totalHewan', 'reservasiAktif', 'totalPemeriksaan'));
    }

    public function pets()
    {
        $pemilik = $this->getPemilik();
        
        $pets = Pet::with(['rasHewan.jenisHewan'])
                    ->where('idpemilik', $pemilik->idpemilik)
                    ->get();

        return view('pemilik.pet-list', compact('pets'));
    }

    public function reservasi()
    {
        $pemilik = $this->getPemilik();
        
        $petIds = Pet::where('idpemilik', $pemilik->idpemilik)->pluck('idpet');

        $reservasi = TemuDokter::with(['pet', 'roleUser.user'])
                        ->whereIn('idpet', $petIds)
                        ->orderBy('waktu_daftar', 'desc')
                        ->get();

        return view('pemilik.reservasi', compact('reservasi'));
    }

    public function rekamMedis()
    {
        $pemilik = $this->getPemilik();
        $petIds = Pet::where('idpemilik', $pemilik->idpemilik)->pluck('idpet');

        $rekamMedis = RekamMedis::with(['pet', 'detailRekamMedis'])
                        ->whereIn('idpet', $petIds)
                        ->orderBy('created_at', 'desc')
                        ->get();

        return view('pemilik.rekam-medis', compact('rekamMedis'));
    }

    public function showRekamMedis($id)
    {
        $pemilik = $this->getPemilik();
        
        $rm = RekamMedis::with(['pet', 'detailRekamMedis.kodeTindakan', 'temuDokter.roleUser.user'])
                ->where('idrekam_medis', $id)
                ->whereHas('pet', function($q) use ($pemilik) {
                    $q->where('idpemilik', $pemilik->idpemilik);
                })
                ->firstOrFail();

        return view('pemilik.show-rekam-medis', compact('rm'));
    }
}
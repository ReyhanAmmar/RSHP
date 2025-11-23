<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

// Import Model yang dibutuhkan untuk statistik
use App\Models\User;
use App\Models\RoleUser;
use App\Models\Pet;
use App\Models\Pemilik;
use App\Models\TemuDokter; // Untuk data kunjungan/antrian

class DashboardAdminController extends Controller
{
    public function index()
    {
        $totalUser = User::count();

        $totalDokter = RoleUser::where('idrole', 2)
                               ->where('status', 1)
                               ->count();

        $totalPet = Pet::count();

        $kunjunganHariIni = TemuDokter::whereDate('waktu_daftar', Carbon::today())->count();

        $pasienBaruBulanIni = Pet::whereMonth('idpet', Carbon::now()->month)
                                 ->count(); 
        
        // Kirim semua data ke view
        return view('admin.dashboard-admin', compact(
            'totalUser', 
            'totalDokter', 
            'totalPet', 
            'kunjunganHariIni'
        ));
    }
}
<?php

namespace App\Http\Controllers\Dokter;

use App\Http\Controllers\Controller;
use App\Models\RekamMedis;
use Illuminate\Support\Facades\Auth;

class DashboardDokterController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        $roleUser = $user->roleuser()->where('idrole', 2)->first();
        
        $totalPasienSaya = 0;
        if($roleUser) {
            $totalPasienSaya = RekamMedis::where('dokter_pemeriksa', $roleUser->idrole_user)->count();
        }

        return view('dokter.dashboard-dokter', compact('totalPasienSaya'));
    }
}
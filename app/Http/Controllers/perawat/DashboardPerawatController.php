<?php

namespace App\Http\Controllers\Perawat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TemuDokter;
use Carbon\Carbon;

class DashboardPerawatController extends Controller
{
    public function index()
    {
        $pasienMenunggu = TemuDokter::whereDate('waktu_daftar', Carbon::today())
                            ->where('status', '0')
                            ->count();

        return view('perawat.dashboard-perawat', compact('pasienMenunggu'));
    }
}
<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SiteController extends Controller
{
    public function index()
    {
        return view('site.home');
    }

    public function cekKoneksi()
    {
        try {
            \DB::connection()->getPdo();
            return "Koneksi database berhasil.";
        } catch (\Exception $e) {
            return "Koneksi database gagal: " . $e->getMessage();
        }
    }
}
class ServController extends Controller
{
    public function index()
    {
        return view('site.layanan');
    }
}

class ContController extends Controller
{
    public function index()
    {
        return view('site.kontak');
    }
}
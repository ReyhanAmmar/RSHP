<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Site\SiteController;
use App\Http\Controllers\Site\ServController;
use App\Http\Controllers\Site\ContController;
use App\Http\Controllers\Auth\LoginController;

use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ManajemenRoleController;
use App\Http\Controllers\Admin\JenisHewanController;
use App\Http\Controllers\Admin\RasHewanController;
use App\Http\Controllers\Admin\PemilikController;
use App\Http\Controllers\Admin\PetController;
use App\Http\Controllers\Admin\KategoriController;
use App\Http\Controllers\Admin\KategoriKlinisController;
use App\Http\Controllers\Admin\KodeTindakanTerapiController;

use App\Http\Controllers\Resepsionis\DashboardResepsionisController;
use App\Http\Controllers\Resepsionis\RegistrasiPemilikController;
use App\Http\Controllers\Resepsionis\RegistrasiPetController;
use App\Http\Controllers\Resepsionis\TemuDokterController;

use App\Http\Controllers\Perawat\DashboardPerawatController;
use App\Http\Controllers\Perawat\RekamMedisController;

use App\Http\Controllers\Dokter\DashboardDokterController;
use App\Http\Controllers\Dokter\DokterController;

use App\Http\Controllers\Pemilik\DashboardPemilikController;


Route::get('/', [SiteController::class, 'index'])->name('site.home');
Route::get('/layanan', [ServController::class, 'index'])->name('layanan');
Route::get('/kontak', [ContController::class, 'index'])->name('kontak');
Route::get('/cek-koneksi', [SiteController::class, 'cekKoneksi'])->name('cek.koneksi');


Auth::routes();
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::middleware('isAdministrator')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/admin.dashboard-admin', [DashboardAdminController::class, 'index'])->name('dashboard');

    Route::prefix('data-user')->name('data-user.')->group(function() {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/store', [UserController::class, 'store'])->name('store');
        Route::get('/{iduser}/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('/{iduser}', [UserController::class, 'update'])->name('update');
        Route::delete('/{iduser}', [UserController::class, 'destroy'])->name('destroy');
        Route::get('/{iduser}/reset-password', [UserController::class, 'resetPassword'])->name('resetpassword');
    });

    Route::prefix('manajemen-role')->name('manajemen-role.')->group(function() {
        Route::get('/', [ManajemenRoleController::class, 'index'])->name('index');
        Route::get('/create', [ManajemenRoleController::class, 'create'])->name('create');
        Route::post('/store', [ManajemenRoleController::class, 'store'])->name('store');
        Route::get('/{idrole}/edit', [ManajemenRoleController::class, 'edit'])->name('edit');
        Route::put('/{idrole}', [ManajemenRoleController::class, 'update'])->name('update');
        Route::delete('/{idrole}', [ManajemenRoleController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('jenis-hewan')->name('jenis-hewan.')->group(function() {
        Route::get('/', [JenisHewanController::class, 'index'])->name('index');
        Route::get('/create', [JenisHewanController::class, 'create'])->name('create');
        Route::post('/store', [JenisHewanController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [JenisHewanController::class, 'edit'])->name('edit');
        Route::put('/{id}', [JenisHewanController::class, 'update'])->name('update');
        Route::delete('/{id}', [JenisHewanController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('ras-hewan')->name('ras-hewan.')->group(function() {
        Route::get('/', [RasHewanController::class, 'index'])->name('index');
        Route::get('/create', [RasHewanController::class, 'create'])->name('create');
        Route::post('/store', [RasHewanController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [RasHewanController::class, 'edit'])->name('edit');
        Route::put('/{id}', [RasHewanController::class, 'update'])->name('update');
        Route::delete('/{id}', [RasHewanController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('data-pemilik')->name('data-pemilik.')->group(function() {
        Route::get('/', [PemilikController::class, 'index'])->name('index');
        Route::get('/create', [PemilikController::class, 'create'])->name('create');
        Route::post('/store', [PemilikController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [PemilikController::class, 'edit'])->name('edit');
        Route::put('/{id}', [PemilikController::class, 'update'])->name('update');
        Route::delete('/{id}', [PemilikController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('data-pet')->name('data-pet.')->group(function() {
        Route::get('/', [PetController::class, 'index'])->name('index');
        Route::get('/create', [PetController::class, 'create'])->name('create');
        Route::post('/store', [PetController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [PetController::class, 'edit'])->name('edit');
        Route::put('/{id}', [PetController::class, 'update'])->name('update');
        Route::delete('/{id}', [PetController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('kategori')->name('kategori.')->group(function() {
        Route::get('/', [KategoriController::class, 'index'])->name('index');
        Route::get('/create', [KategoriController::class, 'create'])->name('create');
        Route::post('/store', [KategoriController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [KategoriController::class, 'edit'])->name('edit');
        Route::put('/{id}', [KategoriController::class, 'update'])->name('update');
        Route::delete('/{id}', [KategoriController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('kategori-klinis')->name('kategori-klinis.')->group(function() {
        Route::get('/', [KategoriKlinisController::class, 'index'])->name('index');
        Route::get('/create', [KategoriKlinisController::class, 'create'])->name('create');
        Route::post('/store', [KategoriKlinisController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [KategoriKlinisController::class, 'edit'])->name('edit');
        Route::put('/{id}', [KategoriKlinisController::class, 'update'])->name('update');
        Route::delete('/{id}', [KategoriKlinisController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('tindakan')->name('tindakan.')->group(function() {
        Route::get('/', [KodeTindakanTerapiController::class, 'index'])->name('index');
        Route::get('/create', [KodeTindakanTerapiController::class, 'create'])->name('create');
        Route::post('/store', [KodeTindakanTerapiController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [KodeTindakanTerapiController::class, 'edit'])->name('edit');
        Route::put('/{id}', [KodeTindakanTerapiController::class, 'update'])->name('update');
        Route::delete('/{id}', [KodeTindakanTerapiController::class, 'destroy'])->name('destroy');
    });
});


Route::middleware('isResepsionis')->prefix('resepsionis')->group(function () {
    Route::get('/resepsionis.dashboard-resepsionis', [DashboardResepsionisController::class, 'index'])->name('resepsionis.dashboard');

    Route::resource('registrasi-pemilik', RegistrasiPemilikController::class, ['as' => 'resepsionis']);
    Route::resource('registrasi-pet', RegistrasiPetController::class, ['as' => 'resepsionis']);
    
    Route::prefix('temu-dokter')->name('temu-dokter.')->group(function() {
        Route::get('/', [TemuDokterController::class, 'index'])->name('index');
        Route::get('/create', [TemuDokterController::class, 'create'])->name('create');
        Route::post('/store', [TemuDokterController::class, 'store'])->name('store');
        Route::put('/{id}/update-status', [TemuDokterController::class, 'updateStatus'])->name('update-status');
    });
});


Route::middleware('isPerawat')->prefix('perawat')->name('perawat.')->group(function () {
    Route::get('/perawat.dashboard-perawat', [DashboardPerawatController::class, 'index'])->name('dashboard');
    
    Route::prefix('rekam-medis')->name('rekam-medis.')->group(function() {
        Route::get('/', [RekamMedisController::class, 'index'])->name('index');
        Route::get('/create/{idreservasi}', [RekamMedisController::class, 'create'])->name('create');
        Route::post('/store', [RekamMedisController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [RekamMedisController::class, 'edit'])->name('edit');
        Route::put('/{id}', [RekamMedisController::class, 'update'])->name('update');
        
        Route::post('/{id}/detail', [RekamMedisController::class, 'storeDetail'])->name('store-detail');
        Route::delete('/detail/{id_detail}', [RekamMedisController::class, 'destroyDetail'])->name('destroy-detail');
    });
});


Route::middleware('isDokter')->prefix('dokter')->name('dokter.')->group(function () {
    Route::get('/dokter.dashboard-dokter', [DashboardDokterController::class, 'index'])->name('dashboard');
    
    Route::prefix('rekam-medis')->name('rekam-medis.')->group(function() {
        Route::get('/', [DokterController::class, 'index'])->name('index');
        Route::get('/{id}', [DokterController::class, 'show'])->name('show');
    });
});


Route::middleware('isPemilik')->prefix('pemilik')->name('pemilik.')->group(function () {
    Route::get('/pemilik.dashboard-pemilik', [DashboardPemilikController::class, 'index'])->name('dashboard');
    
    Route::get('/pets', [DashboardPemilikController::class, 'pets'])->name('pets');
    Route::get('/reservasi', [DashboardPemilikController::class, 'reservasi'])->name('reservasi');
    Route::get('/rekam-medis', [DashboardPemilikController::class, 'rekamMedis'])->name('rekam-medis');
    Route::get('/rekam-medis/{id}', [DashboardPemilikController::class, 'showRekamMedis'])->name('rekam-medis.show');
});
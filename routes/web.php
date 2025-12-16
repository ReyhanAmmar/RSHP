<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;

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
use App\Http\Controllers\Admin\DataDokterController;
use App\Http\Controllers\Admin\DataPerawatController;
use App\Http\Controllers\Admin\DataTemuDokterController;
use App\Http\Controllers\Admin\DataRekamMedisController;

use App\Http\Controllers\Resepsionis\DashboardResepsionisController;
use App\Http\Controllers\Resepsionis\RegistrasiPemilikController;
use App\Http\Controllers\Resepsionis\RegistrasiPetController;
use App\Http\Controllers\Resepsionis\TemuDokterController;

use App\Http\Controllers\Perawat\DashboardPerawatController;
use App\Http\Controllers\Perawat\RekamMedisController;
use App\Http\Controllers\Perawat\DataPasienController;

use App\Http\Controllers\Dokter\DashboardDokterController;
use App\Http\Controllers\Dokter\DokterController;
use App\Http\Controllers\Dokter\DataPasienController as DokterDataPasienController;

use App\Http\Controllers\Pemilik\DashboardPemilikController;


Route::get('/', [SiteController::class, 'index'])->name('site.home');
Route::get('/layanan', [ServController::class, 'index'])->name('layanan');
Route::get('/kontak', [ContController::class, 'index'])->name('kontak');
Route::get('/cek-koneksi', [SiteController::class, 'cekKoneksi'])->name('cek.koneksi');

Auth::routes();
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function() {
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});


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
        Route::get('/{iduser}/restore', [UserController::class, 'restore'])->name('restore');
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
        Route::get('/{id}/restore', [JenisHewanController::class, 'restore'])->name('restore');
    });

    Route::prefix('ras-hewan')->name('ras-hewan.')->group(function() {
        Route::get('/', [RasHewanController::class, 'index'])->name('index');
        Route::get('/create', [RasHewanController::class, 'create'])->name('create');
        Route::post('/store', [RasHewanController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [RasHewanController::class, 'edit'])->name('edit');
        Route::put('/{id}', [RasHewanController::class, 'update'])->name('update');
        Route::delete('/{id}', [RasHewanController::class, 'destroy'])->name('destroy');
        Route::get('/{id}/restore', [RasHewanController::class, 'restore'])->name('restore');
    });

    Route::prefix('data-pemilik')->name('data-pemilik.')->group(function() {
        Route::get('/', [PemilikController::class, 'index'])->name('index');
        Route::get('/create', [PemilikController::class, 'create'])->name('create');
        Route::post('/store', [PemilikController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [PemilikController::class, 'edit'])->name('edit');
        Route::put('/{id}', [PemilikController::class, 'update'])->name('update');
        Route::delete('/{id}', [PemilikController::class, 'destroy'])->name('destroy');
        Route::get('/{id}/restore', [PemilikController::class, 'restore'])->name('restore');
    });

    Route::prefix('data-pet')->name('data-pet.')->group(function() {
        Route::get('/', [PetController::class, 'index'])->name('index');
        Route::get('/create', [PetController::class, 'create'])->name('create');
        Route::post('/store', [PetController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [PetController::class, 'edit'])->name('edit');
        Route::put('/{id}', [PetController::class, 'update'])->name('update');
        Route::delete('/{id}', [PetController::class, 'destroy'])->name('destroy');
        Route::get('/{id}/restore', [PetController::class, 'restore'])->name('restore');
    });

    Route::prefix('kategori')->name('kategori.')->group(function() {
        Route::get('/', [KategoriController::class, 'index'])->name('index');
        Route::get('/create', [KategoriController::class, 'create'])->name('create');
        Route::post('/store', [KategoriController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [KategoriController::class, 'edit'])->name('edit');
        Route::put('/{id}', [KategoriController::class, 'update'])->name('update');
        Route::delete('/{id}', [KategoriController::class, 'destroy'])->name('destroy');
        Route::get('/{id}/restore', [KategoriController::class, 'restore'])->name('restore');
    });

    Route::prefix('kategori-klinis')->name('kategori-klinis.')->group(function() {
        Route::get('/', [KategoriKlinisController::class, 'index'])->name('index');
        Route::get('/create', [KategoriKlinisController::class, 'create'])->name('create');
        Route::post('/store', [KategoriKlinisController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [KategoriKlinisController::class, 'edit'])->name('edit');
        Route::put('/{id}', [KategoriKlinisController::class, 'update'])->name('update');
        Route::delete('/{id}', [KategoriKlinisController::class, 'destroy'])->name('destroy');
        Route::get('/{id}/restore', [KategoriKlinisController::class, 'restore'])->name('restore');
    });

    Route::prefix('tindakan')->name('tindakan.')->group(function() {
        Route::get('/', [KodeTindakanTerapiController::class, 'index'])->name('index');
        Route::get('/create', [KodeTindakanTerapiController::class, 'create'])->name('create');
        Route::post('/store', [KodeTindakanTerapiController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [KodeTindakanTerapiController::class, 'edit'])->name('edit');
        Route::put('/{id}', [KodeTindakanTerapiController::class, 'update'])->name('update');
        Route::delete('/{id}', [KodeTindakanTerapiController::class, 'destroy'])->name('destroy');
        Route::get('/{id}/restore', [KodeTindakanTerapiController::class, 'restore'])->name('restore');
    });

    Route::prefix('data-dokter')->name('data-dokter.')->group(function() {
        Route::get('/', [DataDokterController::class, 'index'])->name('index');
        Route::get('/create', [DataDokterController::class, 'create'])->name('create');
        Route::post('/store', [DataDokterController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [DataDokterController::class, 'edit'])->name('edit');
        Route::put('/{id}', [DataDokterController::class, 'update'])->name('update');
        Route::delete('/{id}', [DataDokterController::class, 'destroy'])->name('destroy');
        Route::get('/{id}/restore', [DataDokterController::class, 'restore'])->name('restore');
    });

    Route::prefix('data-perawat')->name('data-perawat.')->group(function() {
        Route::get('/', [DataPerawatController::class, 'index'])->name('index');
        Route::get('/create', [DataPerawatController::class, 'create'])->name('create');
        Route::post('/store', [DataPerawatController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [DataPerawatController::class, 'edit'])->name('edit');
        Route::put('/{id}', [DataPerawatController::class, 'update'])->name('update');
        Route::delete('/{id}', [DataPerawatController::class, 'destroy'])->name('destroy');
        Route::get('/{id}/restore', [DataPerawatController::class, 'restore'])->name('restore');
    });

    Route::prefix('data-temu-dokter')->name('data-temu-dokter.')->group(function() {
        Route::get('/', [DataTemuDokterController::class, 'index'])->name('index');
        Route::delete('/{id}', [DataTemuDokterController::class, 'destroy'])->name('destroy');
        Route::get('/{id}/restore', [DataTemuDokterController::class, 'restore'])->name('restore');
    });

    Route::prefix('data-rekam-medis')->name('data-rekam-medis.')->group(function() {
        Route::get('/', [DataRekamMedisController::class, 'index'])->name('index');
        Route::get('/{id}', [DataRekamMedisController::class, 'show'])->name('show');
        Route::delete('/{id}', [DataRekamMedisController::class, 'destroy'])->name('destroy');
        Route::get('/{id}/restore', [DataRekamMedisController::class, 'restore'])->name('restore');
    });
}); 

Route::middleware('isResepsionis')->group(function () {
    Route::prefix('resepsionis')->name('resepsionis.')->group(function() {
        
        Route::get('/dashboard', [DashboardResepsionisController::class, 'index'])->name('dashboard');
        
        Route::prefix('registrasi-pemilik')->name('registrasi-pemilik.')->group(function() {
            Route::get('/', [RegistrasiPemilikController::class, 'index'])->name('index');
            Route::get('/create', [RegistrasiPemilikController::class, 'create'])->name('create');
            Route::post('/store', [RegistrasiPemilikController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [RegistrasiPemilikController::class, 'edit'])->name('edit');
            Route::put('/{id}', [RegistrasiPemilikController::class, 'update'])->name('update');
            Route::delete('/{id}', [RegistrasiPemilikController::class, 'destroy'])->name('destroy');
            Route::get('/{id}/restore', [RegistrasiPemilikController::class, 'restore'])->name('restore');
        });

        Route::prefix('registrasi-pet')->name('registrasi-pet.')->group(function() {
            Route::get('/', [RegistrasiPetController::class, 'index'])->name('index');
            Route::get('/create', [RegistrasiPetController::class, 'create'])->name('create');
            Route::post('/store', [RegistrasiPetController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [RegistrasiPetController::class, 'edit'])->name('edit');
            Route::put('/{id}', [RegistrasiPetController::class, 'update'])->name('update');
            Route::delete('/{id}', [RegistrasiPetController::class, 'destroy'])->name('destroy');
            Route::get('/{id}/restore', [RegistrasiPetController::class, 'restore'])->name('restore');
        });
    });

    Route::prefix('resepsionis/temu-dokter')->name('temu-dokter.')->group(function() {
        Route::get('/', [TemuDokterController::class, 'index'])->name('index');
        Route::get('/create', [TemuDokterController::class, 'create'])->name('create');
        Route::post('/store', [TemuDokterController::class, 'store'])->name('store');
        Route::put('/{id}/update-status', [TemuDokterController::class, 'updateStatus'])->name('update-status');
    });
});

Route::middleware('isPerawat')->prefix('perawat')->name('perawat.')->group(function () {
    Route::get('/dashboard', [DashboardPerawatController::class, 'index'])->name('dashboard');
    
    Route::prefix('data-pasien')->name('data-pasien.')->group(function() {
        Route::get('/', [DataPasienController::class, 'index'])->name('index');
        Route::get('/{id}', [DataPasienController::class, 'show'])->name('show');
    });

    Route::prefix('rekam-medis')->name('rekam-medis.')->group(function() {
        Route::get('/', [RekamMedisController::class, 'index'])->name('index');
        Route::get('/create/{idreservasi}', [RekamMedisController::class, 'create'])->name('create');
        Route::post('/store', [RekamMedisController::class, 'store'])->name('store');
        Route::get('/{id}', [RekamMedisController::class, 'show'])->name('show');
        Route::get('/{id}/tindakan', [RekamMedisController::class, 'tindakan'])->name('tindakan');
        Route::get('/{id}/edit', [RekamMedisController::class, 'edit'])->name('edit');
        Route::put('/{id}', [RekamMedisController::class, 'update'])->name('update');
        Route::delete('/{id}', [RekamMedisController::class, 'destroy'])->name('destroy');
        Route::get('/{id}/restore', [RekamMedisController::class, 'restore'])->name('restore');
        
        Route::post('/{id}/detail', [RekamMedisController::class, 'storeDetail'])->name('store-detail');
        Route::delete('/detail/{id_detail}', [RekamMedisController::class, 'destroyDetail'])->name('destroy-detail');
    });
});

Route::middleware('isDokter')->prefix('dokter')->name('dokter.')->group(function () {
    Route::get('/dokter.dashboard-dokter', [DashboardDokterController::class, 'index'])->name('dashboard');
    
    Route::prefix('data-pasien')->name('data-pasien.')->group(function() {
        Route::get('/', [DokterDataPasienController::class, 'index'])->name('index');
        Route::get('/{id}', [DokterDataPasienController::class, 'show'])->name('show');
    });
    
    Route::prefix('rekam-medis')->name('rekam-medis.')->group(function() {
        Route::get('/', [DokterController::class, 'index'])->name('index');
        Route::get('/create/{idreservasi}', [DokterController::class, 'create'])->name('create');
        Route::post('/store', [DokterController::class, 'store'])->name('store');
        Route::get('/{id}', [DokterController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [DokterController::class, 'edit'])->name('edit');
        Route::put('/{id}', [DokterController::class, 'update'])->name('update');
        
        Route::post('/{id}/detail', [DokterController::class, 'storeDetail'])->name('store-detail');
        Route::delete('/detail/{id_detail}', [DokterController::class, 'destroyDetail'])->name('destroy-detail');
    });
});

Route::middleware('isPemilik')->prefix('pemilik')->name('pemilik.')->group(function () {
    Route::get('/dashboard', [DashboardPemilikController::class, 'index'])->name('dashboard');
    
    Route::get('/pets', [DashboardPemilikController::class, 'pets'])->name('pets');
    Route::get('/reservasi', [DashboardPemilikController::class, 'reservasi'])->name('reservasi');
    Route::get('/rekam-medis', [DashboardPemilikController::class, 'rekamMedis'])->name('rekam-medis');
    Route::get('/rekam-medis/{id}', [DashboardPemilikController::class, 'showRekamMedis'])->name('rekam-medis.show');
});
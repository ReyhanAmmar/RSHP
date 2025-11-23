<?php

use Illuminate\Support\Facades\Route;
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

use App\Http\Controllers\resepsionis\DashboardResepsionisController;
use App\Http\Controllers\Resepsionis\RegistrasiPemilikController;
use App\Http\Controllers\Resepsionis\RegistrasiPetController;
use App\Http\Controllers\Resepsionis\TemuDokterController;

use App\Http\Controllers\Perawat\DashboardPerawatController;
use App\Http\Controllers\Perawat\RekamMedisController;

use App\Http\Controllers\Dokter\DashboardDokterController;
use App\Http\Controllers\Dokter\DokterController;

use App\Http\Controllers\Pemilik\DashboardPemilikController;

Route::get('/cek-koneksi', [SiteController::class, 'cekKoneksi'])->name('cek.koneksi');

Route::get('/', [SiteController::class, 'index'])->name('site.home');
Route::get('/layanan', [ServController::class, 'index'])->name('layanan');
Route::get('/kontak', [ContController::class, 'index'])->name('kontak');

Auth::routes();

Route::middleware('isAdministrator')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/admin.dashboard-admin', [DashboardAdminController::class, 'index'])->name('dashboard');

    Route::get('/data-user', [UserController::class, 'index'])->name('data-user.index');
    Route::get('/data-user/create', [UserController::class, 'create'])->name('data-user.create');
    Route::post('/data-user/store', [UserController::class, 'store'])->name(name: 'data-user.store');
    Route::get('/data-user/{iduser}/edit', [UserController::class, 'edit'])->name('data-user.edit');
    Route::put('/data-user/{iduser}', [UserController::class, 'update'])->name('data-user.update');
    Route::get('/data-user/{iduser}/reset-password', [UserController::class, 'resetPassword'])->name('data-user.resetpassword');
    Route::delete('/data-user/{iduser}', [UserController::class, 'destroy'])->name('data-user.destroy');

    Route::get('/manajemen-role', [ManajemenRoleController::class, 'index'])->name('manajemen-role.index');
    Route::get('/manajemen-role/create', [ManajemenRoleController::class, 'create'])->name('manajemen-role.create');
    Route::post('/manajemen-role/store', [ManajemenRoleController::class, 'store'])->name('manajemen-role.store');
    Route::get('/manajemen-role/{idrole}/edit', [ManajemenRoleController::class, 'edit'])->name('manajemen-role.edit');
    Route::put('/manajemen-role/{idrole}', [ManajemenRoleController::class, 'update'])->name('manajemen-role.update');
    Route::delete('/manajemen-role/{idrole}', [ManajemenRoleController::class, 'destroy'])->name('manajemen-role.destroy');

    Route::get('/jenis-hewan', [JenisHewanController::class, 'index'])->name('jenis-hewan.index');
    Route::get('/jenis-hewan/create', [JenisHewanController::class, 'create'])->name('jenis-hewan.create');
    Route::post('/jenis-hewan/store', [JenisHewanController::class, 'store'])->name('jenis-hewan.store');
    Route::get('/jenis-hewan/{idjenis_hewan}/edit', [JenisHewanController::class, 'edit'])->name('jenis-hewan.edit');
    Route::put('/jenis-hewan/{idjenis_hewan}', [JenisHewanController::class, 'update'])->name('jenis-hewan.update');
    Route::delete('/jenis-hewan/{idjenis_hewan}', [JenisHewanController::class, 'destroy'])->name('jenis-hewan.destroy');

    Route::get('/ras-hewan', [RasHewanController::class, 'index'])->name('ras-hewan.index');
    Route::get('/ras-hewan/create', [RasHewanController::class, 'create'])->name('ras-hewan.create');
    Route::post('/ras-hewan/store', [RasHewanController::class, 'store'])->name('ras-hewan.store');
    Route::get('/ras-hewan/{id}/edit', [RasHewanController::class, 'edit'])->name('ras-hewan.edit');
    Route::put('/ras-hewan/{id}', [RasHewanController::class, 'update'])->name('ras-hewan.update');
    Route::delete('/ras-hewan/{id}', [RasHewanController::class, 'destroy'])->name('ras-hewan.destroy');

    Route::get('/data-pemilik', [PemilikController::class, 'index'])->name('data-pemilik.index');
    Route::get('/data-pemilik/create', [PemilikController::class, 'create'])->name('data-pemilik.create');
    Route::post('/data-pemilik/store', [PemilikController::class, 'store'])->name('data-pemilik.store');
    Route::get('/data-pemilik/{id}/edit', [PemilikController::class, 'edit'])->name('data-pemilik.edit');
    Route::put('/data-pemilik/{id}', [PemilikController::class, 'update'])->name('data-pemilik.update');
    Route::delete('/data-pemilik/{id}', [PemilikController::class, 'destroy'])->name('data-pemilik.destroy');

    Route::get('/data-pet', [PetController::class, 'index'])->name('data-pet.index');
    Route::get('/data-pet/create', [PetController::class, 'create'])->name('data-pet.create');
    Route::post('/data-pet/store', [PetController::class, 'store'])->name('data-pet.store');
    Route::get('/data-pet/{id}/edit', [PetController::class, 'edit'])->name('data-pet.edit');
    Route::put('/data-pet/{id}', [PetController::class, 'update'])->name('data-pet.update');
    Route::delete('/data-pet/{id}', [PetController::class, 'destroy'])->name('data-pet.destroy');

    Route::get('/kategori', [KategoriController::class, 'index'])->name('kategori.index');
    Route::get('/kategori/create', [KategoriController::class, 'create'])->name('kategori.create');
    Route::post('/kategori/store', [KategoriController::class, 'store'])->name('kategori.store');
    Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit'])->name('kategori.edit');
    Route::put('/kategori/{id}', [KategoriController::class, 'update'])->name('kategori.update');
    Route::delete('/kategori/{id}', [KategoriController::class, 'destroy'])->name('kategori.destroy');

    Route::get('/kategori-klinis', [KategoriKlinisController::class, 'index'])->name('kategori-klinis.index');
    Route::get('/kategori-klinis/create', [KategoriKlinisController::class, 'create'])->name('kategori-klinis.create');
    Route::post('/kategori-klinis/store', [KategoriKlinisController::class, 'store'])->name('kategori-klinis.store');
    Route::get('/kategori-klinis/{id}/edit', [KategoriKlinisController::class, 'edit'])->name('kategori-klinis.edit');
    Route::put('/kategori-klinis/{id}', [KategoriKlinisController::class, 'update'])->name('kategori-klinis.update');
    Route::delete('/kategori-klinis/{id}', [KategoriKlinisController::class, 'destroy'])->name('kategori-klinis.destroy');

    Route::get('/tindakan', [KodeTindakanTerapiController::class, 'index'])->name('tindakan.index');
    Route::get('/tindakan/create', [KodeTindakanTerapiController::class, 'create'])->name('tindakan.create');
    Route::post('/tindakan/store', [KodeTindakanTerapiController::class, 'store'])->name('tindakan.store');
    Route::get('/tindakan/{id}/edit', [KodeTindakanTerapiController::class, 'edit'])->name('tindakan.edit');
    Route::put('/tindakan/{id}', [KodeTindakanTerapiController::class, 'update'])->name('tindakan.update');
    Route::delete('/tindakan/{id}', [KodeTindakanTerapiController::class, 'destroy'])->name('tindakan.destroy');
});

Route::middleware('isDokter')->prefix('dokter')->name('dokter.')->group(function () {
    Route::get('/dashboard', [DashboardDokterController::class, 'index'])->name('dashboard');

    Route::get('/rekam-medis', [DokterController::class, 'index'])->name('rekam-medis.index');
    Route::get('/rekam-medis/{id}', [DokterController::class, 'show'])->name('rekam-medis.show');
});

Route::middleware('isPerawat')->prefix('perawat')->name('perawat.')->group(function () {
    Route::get('/perawat.dashboard-perawat', [DashboardPerawatController::class, 'index'])->name('dashboard');

    Route::get('/rekam-medis', [RekamMedisController::class, 'index'])->name('rekam-medis.index');
    Route::get('/rekam-medis/create/{idreservasi}', [RekamMedisController::class, 'create'])->name('rekam-medis.create');
    Route::post('/rekam-medis/store', [RekamMedisController::class, 'store'])->name('rekam-medis.store');
    Route::get('/rekam-medis/{id}/edit', [RekamMedisController::class, 'edit'])->name('rekam-medis.edit');
    Route::put('/rekam-medis/{id}', [RekamMedisController::class, 'update'])->name('rekam-medis.update');

    Route::post('/rekam-medis/{id}/detail', [RekamMedisController::class, 'storeDetail'])->name('rekam-medis.store-detail');
    Route::delete('/rekam-medis/detail/{id_detail}', [RekamMedisController::class, 'destroyDetail'])->name('rekam-medis.destroy-detail');
});

Route::middleware('isResepsionis')->prefix('resepsionis')->name('resepsionis.')->group(function () {
    Route::get('/resepsionis.dashboard-resepsionis', [DashboardResepsionisController::class, 'index'])->name('dashboard');

    Route::resource('registrasi-pemilik', RegistrasiPemilikController::class);

    Route::resource('registrasi-pet', RegistrasiPetController::class);

    Route::get('/temu-dokter', [TemuDokterController::class, 'index'])->name('temu-dokter.index');
    Route::get('/temu-dokter/create', [TemuDokterController::class, 'create'])->name('temu-dokter.create');
    Route::post('/temu-dokter/store', [TemuDokterController::class, 'store'])->name('temu-dokter.store');
    Route::put('/temu-dokter/{id}/update-status', [TemuDokterController::class, 'updateStatus'])->name('temu-dokter.update-status');
});

Route::middleware('isPemilik')->prefix('pemilik')->name('pemilik.')->group(function () {
    Route::get('/dashboard-pemilik', [DashboardPemilikController::class, 'index'])->name('dashboard');
    
    Route::get('/pets', [DashboardPemilikController::class, 'pets'])->name('pets');
    Route::get('/reservasi', [DashboardPemilikController::class, 'reservasi'])->name('reservasi');
    Route::get('/rekam-medis', [DashboardPemilikController::class, 'rekamMedis'])->name('rekam-medis');
    Route::get('/rekam-medis/{id}', [DashboardPemilikController::class, 'showRekamMedis'])->name('rekam-medis.show');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

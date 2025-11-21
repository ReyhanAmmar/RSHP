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

use App\Http\Controllers\resepsionis\DashboardResepsionisController;

Route::get('/cek-koneksi', [SiteController::class, 'cekKoneksi'])->name('cek.koneksi');

Route::get('/', [SiteController::class, 'index'])->name('site.home');
Route::get('/layanan', [ServController::class, 'index'])->name('layanan');
Route::get('/kontak', [ContController::class, 'index'])->name('kontak');

Auth::routes();

Route::middleware('isAdministrator')->group(function () {
    Route::get('/admin/admin.dashboard-admin', [DashboardAdminController::class, 'index'])->name('dashboard.admin');

    Route::get('/admin/data-user', [UserController::class, 'index'])->name('admin.data-user.index');
    Route::get('/create', [UserController::class, 'create'])->name('admin.data-user.create');
    Route::post('/store', [UserController::class, 'store'])->name('admin.data-user.store');
    Route::get('/users/{iduser}/edit', [UserController::class, 'edit'])->name('admin.data-user.edit');
    Route::put('/users/{iduser}', [UserController::class, 'update'])->name('admin.data-user.update');
    Route::get('/users/{iduser}/reset-password', [UserController::class, 'resetPassword'])->name('admin.data-user.resetpassword');
    Route::delete('/users/{iduser}', [UserController::class, 'destroy'])->name('admin.data-user.destroy');

    Route::get('/admin/manajemen-role', [ManajemenRoleController::class, 'index'])->name('admin.manajemen-role.index');
    Route::get('/create', [ManajemenRoleController::class, 'create'])->name('admin.manajemen-role.create');
    Route::post('/store', [ManajemenRoleController::class, 'store'])->name('admin.manajemen-role.store');
    Route::get('/{idrole}/edit', [ManajemenRoleController::class, 'edit'])->name('admin.manajemen-role.edit');
    Route::put('/{idrole}', [ManajemenRoleController::class, 'update'])->name('admin.manajemen-role.update');
    Route::delete('/{idrole}', [ManajemenRoleController::class, 'destroy'])->name('admin.manajemen-role.destroy');

    Route::get('/admin/jenis-hewan', [JenisHewanController::class, 'index'])->name('admin.jenis-hewan.index');
    Route::get('/admin/jenis-hewan/create', [JenisHewanController::class, 'create'])->name('admin.jenis-hewan.create');
    Route::post('/admin/jenis-hewan/store', [JenisHewanController::class, 'store'])->name('admin.jenis-hewan.store');
    Route::get('/{idjenis_hewan}/edit', [JenisHewanController::class, 'edit'])->name('admin.jenis-hewan.edit');
    Route::put('/{idjenis_hewan}', [JenisHewanController::class, 'update'])->name('admin.jenis-hewan.update');
    Route::delete('/{idjenis_hewan}', [JenisHewanController::class, 'destroy'])->name('admin.jenis-hewan.destroy');

    Route::get('/admin/ras-hewan', [UserController::class, 'index'])->name('admin.ras-hewan.index');
});

Route::middleware('isDokter')->group(function () {
    Route::get('/dokter/dokter.dashboard-dokter', [DashboardResepsionisController::class, 'index'])->name('resepsionis.dashboard');
});

Route::middleware('isPerawat')->group(function () {
    Route::get('/perawat/perawat.dashboard-perawat', [DashboardResepsionisController::class, 'index'])->name('resepsionis.dashboard');
});

Route::middleware('isResepsionis')->group(function () {
    Route::get('/resepsionis/resepsionis.dashboard-resepsionis', [DashboardResepsionisController::class, 'index'])->name('resepsionis.dashboard');
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

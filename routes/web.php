<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Site\SiteController;
use App\Http\Controllers\Site\ServController;
use App\Http\Controllers\Site\ContController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/cek-koneksi', [SiteController::class, 'cekKoneksi'])->name('cek.koneksi');

Route::get('/home', [SiteController::class, 'index'])->name('home');

Route::get('/layanan', [ServController::class, 'index'])->name('layanan');

Route::get('/kontak', [ContController::class, 'index'])->name('kontak');

Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login-proses', [LoginController::class, 'proses'])->name('login.proses');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->name('dashboard.admin');

Route::get('/admin/data-user', [UserController::class, 'index'])->name('admin.datauser.index');
Route::get('/users', [UserController::class, 'index'])->name('admin.users.index');
Route::get('/users/create', [UserController::class, 'create'])->name('admin.users.tambahuser');
Route::post('/users', [UserController::class, 'store'])->name('admin.users.store');
Route::get('/users/{iduser}/edit', [UserController::class, 'edit'])->name('admin.users.edit');
Route::put('/users/{iduser}', [UserController::class, 'update'])->name('admin.users.update');
Route::get('/users/{iduser}/reset-password', [UserController::class, 'resetPassword'])->name('admin.users.resetpassword');
Route::delete('/users/{iduser}', [UserController::class, 'destroy'])->name('admin.users.destroy');
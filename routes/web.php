<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PemesanController;
use App\Http\Controllers\LayananController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\PekerjaController;

Route::get('/', function () {
    return view('/pemesanan/beranda');
});

Route::get('/form-pesan', function () {
    return view('pemesan.form-pesan');
})->name('form-pesan');

Route::controller(AuthController::class)->group(function() {
    Route::get('/login', 'indexLogin')->name('login');
    Route::get('/registrasi', 'indexRegister')->name('register');
});

Route::controller(DashboardController::class)->group(function() {
    Route::get('/admin/dashboard', 'index')->name('admin.dashboard');
});

Route::controller(LayananController::class)->group(function() {
    Route::get('/admin/layanan', 'index')->name('admin.layanan');
    Route::get('/admin/layanan/create', 'create')->name('admin.layanan.create');
    Route::post('/admin/layanan/store', 'store')->name('admin.layanan.store');
    Route::get('/admin/layanan/show/{id}', 'show')->name('admin.layanan.show');
    Route::delete('/admin/layanan/delete/{id}', 'destroy')->name('admin.layanan.destroy');
    Route::get('/admin/layanan/edit/{id}', 'edit')->name('admin.layanan.edit');
    Route::put('/admin/layanan/update/{id}', 'update')->name('admin.layanan.update');
});

Route::controller(PekerjaController::class)->group(function() {
    Route::get('/admin/petugas', 'index')->name('admin.petugas');
});

Route::get('/', [PemesanController::class, 'index'])->name('beranda');

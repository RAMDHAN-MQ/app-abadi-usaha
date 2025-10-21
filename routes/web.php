<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    PemesanController,
    LayananController,
    AuthController,
    DashboardController,
    PekerjaController,
    PemesanAdminController,
    GajiController
};

// =========================
// HALAMAN UTAMA
// =========================
Route::get('/', function () {
    return view('pemesan.beranda');
});

// =========================
// AUTH
// =========================
Route::controller(AuthController::class)->group(function () {
    Route::get('/login', 'indexLogin')->name('login');
    Route::post('/login', 'login')->name('login.post');
    Route::get('/registrasi', 'indexRegister')->name('register');
    Route::post('/registrasi', 'register')->name('register.post');
    Route::post('/logout', 'logout')->name('logout');
});

Route::middleware('auth')->group(function () {
    // pemesan
    Route::get('/pemesan', [PemesanController::class, 'index'])->name('pemesan.beranda');
    Route::get('/pemesan/profil', [PemesanController::class, 'profil'])->name('pemesan.profil');
    Route::get('/pemesan/form-pemesanan', [PemesanController::class, 'form_pesan'])->name('pemesan.form.pemesanan');
    Route::post('/pemesan/form-pemesanan/store', [PemesanController::class, 'store'])->name('pemesan.form.store');
    Route::put('/pemesan/profil/update', [PemesanController::class, 'updateProfil'])->name('pemesan.updateProfil');
    
    Route::get('/pemesan/riwayat', [PemesanController::class, 'riwayat'])->name('pemesan.riwayat');
    // admin
    Route::controller(DashboardController::class)->group(function () {
        Route::get('/admin/dashboard', 'index')->name('admin.dashboard');
    });
    
    Route::controller(LayananController::class)->group(function () {
        Route::get('/admin/layanan', 'index')->name('admin.layanan');
        Route::get('/admin/layanan/create', 'create')->name('admin.layanan.create');
        Route::post('/admin/layanan/store', 'store')->name('admin.layanan.store');
        Route::get('/admin/layanan/show/{id}', 'show')->name('admin.layanan.show');
        Route::delete('/admin/layanan/delete/{id}', 'destroy')->name('admin.layanan.destroy');
        Route::get('/admin/layanan/edit/{id}', 'edit')->name('admin.layanan.edit');
        Route::put('/admin/layanan/update/{id}', 'update')->name('admin.layanan.update');
    });
    
    Route::controller(PekerjaController::class)->group(function () {
        Route::get('/admin/petugas', 'index')->name('admin.petugas');
        Route::get('/admin/petugas/create', 'create')->name('admin.petugas.create');
        Route::post('/admin/petugas/store', 'store')->name('admin.petugas.store');
        Route::get('/admin/petugas/show/{id}', 'show')->name('admin.petugas.show');
        Route::get('/admin/petugas/edit/{id}', 'edit')->name('admin.petugas.edit');
        Route::put('/admin/petugas/update/{id}', 'update')->name('admin.petugas.update');
        Route::delete('/admin/petugas/delete/{id}', 'destroy')->name('admin.petugas.delete');
    });
    
    Route::controller(PemesanAdminController::class)->group(function () {
        Route::get('/admin/pemesanan', 'index')->name('admin.pemesanan');
        Route::get('/admin/pemesanan/create', 'create')->name('admin.pemesanan.create');
        Route::post('/admin/pemesanan/store', 'store')->name('admin.pemesanan.store');
        Route::post('/admin/pemesanan/store/petugas', 'storePetugas')->name('admin.pemesanan.kirimPetugas');
        Route::get('/admin/pemesanan/show/{id}', 'show')->name('admin.pemesanan.show');
        Route::get('/admin/pemesanan/edit/{id}', 'edit')->name('admin.pemesanan.edit');
        Route::put('/admin/pemesanan/update/{id}', 'update')->name('admin.pemesanan.update');
        Route::delete('/admin/pemesanan/delete/{id}', 'destroy')->name('admin.pemesanan.destroy');
    });
    
    Route::controller(GajiController::class)->group(function () {
        Route::get('/admin/gaji', 'index')->name('admin.gaji');
        Route::get('/admin/gaji/create', 'create')->name('admin.gaji.create');
        Route::post('/admin/gaji/store', 'store')->name('admin.gaji.store');
        Route::get('/admin/gaji/show/{id}', 'show')->name('admin.gaji.show');
        Route::get('/admin/gaji/edit/{id}', 'edit')->name('admin.gaji.edit');
        Route::put('/admin/gaji/update/{id}', 'update')->name('admin.gaji.update');
        Route::delete('/admin/gaji/delete/{id}', 'destroy')->name('admin.gaji.destroy');
    });
});
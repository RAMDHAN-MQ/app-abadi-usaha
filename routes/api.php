<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\PemesanAdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// beranda
Route::post('/loginHP', [AuthController::class, 'loginHP']);
Route::get('/pesanan/{pekerjaId}', [PemesanAdminController::class, 'ambilPesanan']);
Route::put('/verifikasi_pemesanan/{detailId}', [PemesanAdminController::class, 'updateVerifikasi']);

// riwayat
Route::get('/riwayatPesanan/{pekerja_id}', [PemesanAdminController::class, 'getPesananByPekerja']);
Route::put('/update-status/{id}', [PemesanAdminController::class, 'updateStatus']);

// gaji
Route::get('/gaji/{user_id}', [GajiController::class, 'showByUser']);
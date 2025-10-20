<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PemesanAdminController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/loginHP', [AuthController::class, 'loginHP']);
Route::get('/pesanan/{pekerjaId}', [PemesanAdminController::class, 'ambilPesanan']);
Route::put('/verifikasi_pemesanan/{detailId}', [PemesanAdminController::class, 'updateVerifikasi']);


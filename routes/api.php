<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PelangganController;
use App\Http\Controllers\Api\KendaraanController;
use App\Http\Controllers\Api\DaftarServiceController;
use App\Http\Controllers\Api\DataServiceController;
use App\Http\Controllers\Api\PembayaranServiceController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::name('api.')->group(function () {

    // API Pelanggan
    Route::apiResource('pelanggan', PelangganController::class);

    // API Kendaraan
    Route::apiResource('kendaraan', KendaraanController::class);

    // API Daftar Service
    Route::apiResource('daftar-service', DaftarServiceController::class);

    // API Data service
    Route::apiResource('data-service', DataServiceController::class);

    // API Pembayaran Service
    Route::apiResource('pembayaran-service', PembayaranServiceController::class);
});
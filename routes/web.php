<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\DaftarServiceController;
use App\Http\Controllers\DataServiceController;
use App\Http\Controllers\PembayaranServiceController;

// Halaman utama
Route::get('/', function () {
    return view('dashboard');
});

// Menu Data Pelanggan
Route::resource('pelanggan', PelangganController::class);

// Menu Data Kendaraan
Route::resource('kendaraan', KendaraanController::class);

// Menu Daftar Service
Route::resource('daftar-service', DaftarServiceController::class)
    ->parameters(['daftar-service' => 'daftarService']);

// Menu Data Service
Route::resource('data-service', DataServiceController::class)
    ->parameters(['data-service' => 'dataService']);

// Menu Pembayaran Service
Route::resource('pembayaran-service', PembayaranServiceController::class)
    ->parameters(['pembayaran-service' => 'pembayaranService']);
<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\BookingPeriksaController;

Route::get('/', [PasienController::class, 'index'])->name('pasien.index');
// Route::post('daftar', [BookingPeriksaController::class, 'store'])->name('daftar');
Route::post('registrasi', [PasienController::class, 'cekPasien'])->name('cekPasien');
// Route::post('get-dokter', [PasienController::class, 'getDokter'])->name('getDokter');
Route::post('validasi', [PasienController::class, 'getDaftar'])->name('get-daftar');
Route::post('result', [PasienController::class, 'result'])->name('send-daftar');

Route::get('load-dokter', [DokterController::class, 'loadDokter']);
<?php

use App\Models\RegPeriksa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\RegPeriksaController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/dokter', [DokterController::class, 'pilihDokter'])->name('pilih-dokter');
Route::get('/poli', [DokterController::class, 'pilihPoli'])->name('pilih-poli');
Route::get('getDaftar', [RegPeriksaController::class, 'getDaftar'])->name('getDaftar');
<?php

use App\Http\Controllers\BeritaController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\IbadahController;
use App\Http\Controllers\JemaatController;
use App\Http\Controllers\KeluargaController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\PelayananController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// Public routes (no auth)
Route::get('/berita', [BeritaController::class, 'index']);
Route::get('/ibadah', [IbadahController::class, 'index']);
Route::get('/ibadah/{ibadah}', [IbadahController::class, 'show']);
Route::get('/event', [EventController::class, 'index']);
Route::get('/event/{event}', [EventController::class, 'show']);

// Protected routes (login required)
Route::middleware(['auth:sanctum'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | User Profile (jemaat)
    |--------------------------------------------------------------------------
    */
    Route::get('/me', function () {
        return auth()->user()->load('jemaat');
    });

    /*
    |--------------------------------------------------------------------------
    | Jemaat (Admin/Staff/Self)
    |--------------------------------------------------------------------------
    */
    Route::apiResource('jemaat', JemaatController::class)
        ->middleware(['role:superadmin|admin|staff']);

    /*
    |--------------------------------------------------------------------------
    | Ibadah
    |--------------------------------------------------------------------------
    */
    Route::apiResource('ibadah', IbadahController::class)
        ->middleware(['role:superadmin|admin|staff']);

    /*
    |--------------------------------------------------------------------------
    | Event
    |--------------------------------------------------------------------------
    */
    Route::apiResource('event', EventController::class)
        ->middleware(['role:superadmin|admin|staff']);

    // Jemaat daftar event
    Route::post('/event/{event}/register', [EventController::class, 'register'])
        ->middleware(['role:jemaat|staff']);

    /*
    |--------------------------------------------------------------------------
    | Keuangan
    |--------------------------------------------------------------------------
    */
    Route::apiResource('keuangan', KeuanganController::class)
        ->middleware(['role:superadmin|admin|staff']);

    /*
    |--------------------------------------------------------------------------
    | Berita
    |--------------------------------------------------------------------------
    */
    Route::apiResource('berita', BeritaController::class)
        ->middleware(['role:superadmin|admin|staff']);

    /*
    |--------------------------------------------------------------------------
    | Files
    |--------------------------------------------------------------------------
    */
    Route::apiResource('files', FileController::class)
        ->middleware(['role:superadmin|admin|staff']);

    /*
    |--------------------------------------------------------------------------
    | Notifikasi
    |--------------------------------------------------------------------------
    */
    Route::apiResource('notifikasi', NotifikasiController::class)
        ->middleware(['role:superadmin|admin']);

    /*
    |--------------------------------------------------------------------------
    | Keluarga
    |--------------------------------------------------------------------------
    */
    Route::apiResource('keluarga', KeluargaController::class)
        ->middleware(['role:superadmin|admin|staff']);

    /*
    |--------------------------------------------------------------------------
    | Pelayanan
    |--------------------------------------------------------------------------
    */
    Route::apiResource('pelayanan', PelayananController::class)
        ->middleware(['role:superadmin|admin|staff']);
});

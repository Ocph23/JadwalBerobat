<?php

use App\Http\Controllers\DokterController;
use Illuminate\Support\Facades\Route;



Route::group(['middleware' => 'role:dokter'], function () {
    Route::get('/dokter', [DokterController::class, 'index'])->name('dokter.index');
    include 'dokter-pasien.php';
    include 'dokter-rekammedik.php';
});


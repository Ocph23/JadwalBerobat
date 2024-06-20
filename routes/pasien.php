<?php

use App\Http\Controllers\DokterController;
use App\Http\Controllers\PasienController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'role:pasien'], function () {
    Route::get('/pasien', [PasienController::class, 'index'])->name('pasien.index');
});


<?php

use App\Http\Controllers\DokterController;
use Illuminate\Support\Facades\Route;

Route::get('/dokter', [DokterController::class, 'index'])->name('dokter.index');
include 'dokter-pasien.php';
<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\ProfileController;
use App\Http\Requests\PasienRequest;
use App\services\PasienService;
use App\services\RekamMedikService;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/dokter/pasien', function (PasienService $pasienService) {
    return Inertia::render('Dokter/PasienPage', ['data' => $pasienService->all()]);
})->name('dokter.pasien');

Route::get('/dokter/pasien/{id}', function (PasienService $pasienService, RekamMedikService $rekammedikService, $id) {
    return Inertia::render(
        'Dokter/DetailPasienPage',
        [
            "pasien" => $pasienService->getById($id),
            "rekammediks" => $rekammedikService->getByPasienId($id)
        ],
    );
})->name('dokter.pasien');

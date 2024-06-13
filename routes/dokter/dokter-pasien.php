<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\ProfileController;
use App\Http\Requests\PasienRequest;
use App\services\DokterService;
use App\services\PasienService;
use App\services\RekamMedikService;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/dokter/pasien', function (PasienService $pasienService, DokterService $dokterService) {
    return Inertia::render('Dokter/PasienPage', ['poli'=> $dokterService->getPoli(),'data' => $pasienService->all()]);
})->name('dokter.pasien');

Route::get('/dokter/pasien/{id}', function (PasienService $pasienService,DokterService $dokterService, RekamMedikService $rekammedikService, $id) {
    return Inertia::render(
        'Dokter/DetailPasienPage',
        [
            "poli"=>$dokterService->getPoli(),
            "pasien" => $pasienService->getById($id),
            "rekammediks" => $rekammedikService->getByPasienId($id)
        ],
    );
})->name('dokter.pasien');

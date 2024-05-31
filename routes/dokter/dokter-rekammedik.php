<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\ProfileController;
use App\Http\Requests\rekammedikRequest;
use App\services\rekammedikService;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/dokter/rekammedik', function (rekammedikService $rekammedikService) {
    return Inertia::render('Dokter/RekamMedikPage', ['data' => $rekammedikService->all()]);
})->name('dokter.rekammedik');

Route::get('/dokter/rekammedik/{id}', function (RekamMedikService $rekammedikService, $id) {
    return Inertia::render(
        'Dokter/RekamMedikPasienPage',
        [
            "rekammedik" => $rekammedikService->getById($id),
        ],
    );
})->name('dokter.pasien.rekammedik');


Route::put('/dokter/rekammedik/{id}', function (RekamMedikRequest $rekamMedikRequest, RekamMedikService $rekamMedikService, $id) {
    try {
        $result = $rekamMedikService->put($rekamMedikRequest, $id);
        if ($result) {
            return Redirect::back()->with('success');
        }
    } catch (\Throwable $th) {
        return Redirect::back()->withErrors(["msg" => "Data Tidak Berhasil Disimpan/ Diubah ! "]);
    }
})->name('dokter.rekammedik.put');

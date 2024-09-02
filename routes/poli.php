<?php

use Inertia\Inertia;
use App\Models\Pasien;
use App\services\ObatService;
use App\services\PoliService;
use App\services\DokterService;
use App\services\PasienService;
use App\services\RekamMedikService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Requests\RekamMedikRequest;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\PasienController;
use App\Http\Controllers\PoliController;

Route::group(['middleware' => 'role:pegawai'], function () {
    Route::get('/poli', [PoliController::class, 'index'])->name('poli.index');
    Route::get('/poli/rekammedik/add', [PoliController::class, 'daftar'])->name('poli.rekammedik.add');
    Route::get('/poli/rekammedik/{id}', function (
        ObatService $obatService,
        PoliService $poliService,
        RekamMedikService $rekammedikService,
        DokterService  $dokterService,
        $id
    ) {
        $rm = $rekammedikService->getById($id);
        $userid = Auth::user()->id;
        $pasien = Pasien::where('user_id', $userid)->first();
        return Inertia::render(
            'Poli/AddRekamMedikPage',
            [
                'polis' => $poliService->all(),
                'pasien' => $pasien,
                'dokters' => $dokterService->all(),
                'obats' => $obatService->all(),
                "rekammedik" => $rekammedikService->getById($id),
            ],
        );
    })->name('poli.rekammedik.detail');


    Route::put('/poli/rekammedik/{id}', function (RekamMedikRequest $rekamMedikRequest, RekamMedikService $rekamMedikService, $id) {
        try {
            $result = $rekamMedikService->put($rekamMedikRequest, $id);
            if ($result) {
                return Redirect::back()->with('success');
            }
        } catch (\Throwable $th) {
            return Redirect::back()->withErrors(["msg" => "Data Tidak Berhasil Disimpan/ Diubah ! "]);
        }
    })->name('poli.rekammedik.put');


    Route::post('/poli/rekammedik', function (RekamMedikRequest $rekamMedikRequest, RekamMedikService $rekamMedikService) {
        try {
            $result = $rekamMedikService->post($rekamMedikRequest);
            if ($result) {
                return Redirect::route('poli.index', $result->id);
            }
        } catch (\Throwable $th) {
            return Redirect::back()->withErrors("error", $th->getMessage());
        }
    })->name('poli.rekammedik.post');
    


    Route::delete('/poli/rekammedik/{id}', function (RekamMedikService $rekamMedikService, $id) {
        try {
            $result = $rekamMedikService->delete($id);
            if ($result) {
                return Redirect::back()->with('success');
            }
        } catch (\Throwable $th) {
            return Redirect::back()->withErrors($th->getMessage());
        }
    })->name('poli.rekammedik.delete');
});

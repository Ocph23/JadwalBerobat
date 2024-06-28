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

Route::group(['middleware' => 'role:pasien'], function () {
    Route::get('/pasien', [PasienController::class, 'index'])->name('pasien.index');
    Route::get('/pasien/rekammedik/add', [PasienController::class, 'daftar'])->name('pasien.rekammedik.add');
    Route::get('/pasien/rekammedik/{id}', function (
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
            'Pasien/AddRekamMedikPage',
            [
                'polis' => $poliService->all(),  
                'pasien' => $pasien,
                'dokters' => $dokterService->all(),
                "rekammedik" => $rekammedikService->getById($id),
            ],
        );
    })->name('pasien.rekammedik.detail');
    

    Route::post('/pasien/rekammedik', function (RekamMedikRequest $rekamMedikRequest, RekamMedikService $rekamMedikService) {
        try {
            $result = $rekamMedikService->post($rekamMedikRequest);
            if ($result) {
                return Redirect::route('pasien.index', $result->id);
            }
        } catch (\Throwable $th) {
            return Redirect::back()->withErrors("error", $th->getMessage());
        }
    })->name('pasien.rekammedik.post');

    
    
});


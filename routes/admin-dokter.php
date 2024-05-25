<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DokterController;
use App\Http\Controllers\ProfileController;
use App\Http\Requests\DokterRequest;
use App\services\DokterService;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/admin/dokter', function (DokterService $dokterService) {
    return Inertia::render('Admin/DokterPage', ['data' => $dokterService->all()]);
})->name('admin.Dokter');

Route::get('/admin/dokter/add', function (DokterService $dokterService) {
    return Inertia::render('Admin/AddDokterPage');
})->name('admin.Dokter.add');


Route::get('/admin/dokter/add/{id}', function (DokterService $dokterService, $id) {
    return Inertia::render('Admin/AddDokterPage', ["Dokter" => $dokterService->getById($id)]);
})->name('admin.Dokter.add');

Route::post('/admin/dokter', function (DokterRequest $DokterRequest, DokterService $dokterService) {
    try {
        $result = $dokterService->post($DokterRequest);
        if ($result) {
            return Redirect::back()->with('success');
        }
    } catch (\Throwable $th) {
        return Redirect::back()->withErrors($th->getMessage());
    }
})->name('admin.Dokter.post');

Route::put('/admin/dokter/{id}', function (DokterRequest $DokterRequest, DokterService $dokterService, $id) {
    try {
        $result = $dokterService->put($DokterRequest, $id);
        if ($result) {
            return Redirect::back()->with('success');
        }
    } catch (\Throwable $th) {
        return Redirect::back()->withErrors($th->getMessage());
    }
})->name('admin.Dokter.put');

Route::delete('/admin/dokter/{id}', function (DokterService $dokterService, $id) {
    try {
        $result = $dokterService->delete($id);
        if ($result) {
            return Redirect::back()->with('success');
        }
    } catch (\Throwable $th) {
        return Redirect::back()->withErrors($th->getMessage());
    }
})->name('admin.Dokter.delete');

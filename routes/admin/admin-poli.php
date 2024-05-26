<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PoliController;
use App\Http\Controllers\ProfileController;
use App\Http\Requests\PoliRequest;
use App\services\DokterService;
use App\services\PoliService;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/admin/poli', function (PoliService $poliService) {
    return Inertia::render('Admin/PoliPage', ['data' => $poliService->all()]);
})->name('admin.poli');

Route::get('/admin/poli/add', function (DokterService $dokterService) {
    return Inertia::render('Admin/AddPoliPage', ["dokters" =>$dokterService->all() ]);
})->name('admin.poli.add');


Route::get('/admin/poli/add/{id}', function (PoliService $poliService, DokterService $dokterService, $id) {
    return Inertia::render('Admin/AddPoliPage', ["dokters" =>$dokterService->all() , "poli" => $poliService->getById($id)]);
})->name('admin.poli.add');

Route::post('/admin/poli', function (PoliRequest $PoliRequest, PoliService $poliService) {
    try {
        $result = $poliService->post($PoliRequest);
        if ($result) {
            return Redirect::back()->with('success');
        }
    } catch (\Throwable $th) {
        return Redirect::back()->withErrors("error", $th->getMessage());
    }
})->name('admin.poli.post');

Route::put('/admin/poli/{id}', function (PoliRequest $PoliRequest, PoliService $poliService, $id) {
    try {
        $result = $poliService->put($PoliRequest, $id);
        if ($result) {
            return Redirect::back()->with('success');
        }
    } catch (\Throwable $th) {
        return Redirect::back()->withErrors($th->getMessage());
    }
})->name('admin.poli.put');

Route::delete('/admin/poli/{id}', function (PoliService $poliService, $id) {
    try {
        $result = $poliService->delete($id);
        if ($result) {
            return Redirect::back()->with('success');
        }
    } catch (\Throwable $th) {
        return Redirect::back()->withErrors($th->getMessage());
    }
})->name('admin.poli.delete');

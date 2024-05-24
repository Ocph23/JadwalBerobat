<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ObatController;
use App\Http\Controllers\ProfileController;
use App\Http\Requests\ObatRequest;
use App\services\ObatService;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //Obat
    Route::get('/obat', [ObatController::class, 'all'])->name('obat');
    Route::post('/obat', [ObatController::class, 'post'])->name('obat.post');
    Route::get('/obat/{id}', [ObatController::class, 'getById'])->name('obat.edit');
    Route::put('/obat/{id}', [ObatController::class, 'put'])->name('obat.put');
    Route::delete('/obat/{id}', [ObatController::class, 'delete'])->name('obat.delete');

    //ADMIN
    Route::get('/admin/obat', function (ObatService $obatService) {
        return Inertia::render('Admin/ObatPage', ['data'=>$obatService->all()]);
    })->name('admin.obat');

    Route::get('/admin/obat/add', function (ObatService $obatService) {
        return Inertia::render('Admin/AddObatPage', $obatService->all());
    })->name('admin.obat.add');

    Route::post('/admin/obat', function (ObatRequest $obatRequest, ObatService $obatService) {
        try {
            $result = $obatService->post($obatRequest);
            if ($result) {
                return Redirect::back()->with('success');
            }
        } catch (\Throwable $th) {
            return Redirect::back()->withErrors($th->getMessage());
        }
    })->name('admin.obat.post');

    Route::put('/admin/obat', function (ObatRequest $obatRequest, ObatService $obatService, $id) {
        try {
            $result = $obatService->put($obatRequest, $id);
            if ($result) {
                return Redirect::back()->with('success');
            }
        } catch (\Throwable $th) {
            return Redirect::back()->withErrors($th->getMessage());
        }
    })->name('admin.obat.post');



});
require __DIR__ . '/auth.php';

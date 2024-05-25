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
    include 'admin-obat.php';
    include 'admin-poli.php';
    include 'admin-dokter.php';


});
require __DIR__ . '/auth.php';

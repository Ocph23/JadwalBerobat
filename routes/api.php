<?php

use App\services\RekamMedikService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/jadwalberobat/{date}', function (RekamMedikService $rekamMedik, $date) {
    $result =  $rekamMedik->getByDate($date);
    return $result;
});

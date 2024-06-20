<?php

use App\services\RekamMedikService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('/jadwalberobat/{poliid}/{date}', function (RekamMedikService $rekamMedik, $poliid, $date) {
    $result =  $rekamMedik->getByPoliAndDate($poliid, $date);
    return $result;
});

<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\RekamMedik;
use App\services\PasienService;
use App\services\RekamMedikService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class PasienController extends Controller
{
    public function index(PasienService $pasienService, RekamMedikService $rekamMedikService){
        $userid = Auth::user()->id;
        $pasien = Pasien::where('user_id', $userid)->first();
        return  Inertia::render("Pasien/Index",
        [
            'pasien' =>  $pasien,
            'rekammedik' =>  $rekamMedikService->getByPasienId($pasien->id),
        ]);
    }
}

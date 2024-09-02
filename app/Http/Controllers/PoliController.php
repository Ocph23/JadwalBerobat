<?php

namespace App\Http\Controllers;

use App\Models\Pasien;
use App\Models\Pegawai;
use App\Models\Poli;
use App\services\DokterService;
use App\services\PasienService;
use App\services\PoliService;
use App\services\RekamMedikService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class PoliController extends Controller
{
    public function index(PasienService $pasienService, RekamMedikService $rekamMedikService)
    {
        $userid = Auth::user()->id;
        $pegawai = Pegawai::where('user_id', $userid)->first();
        $poli = Poli::where('pegawai_id',$pegawai->id)->first();


        return  Inertia::render(
            "Poli/Index",
            [
                'pegawai' =>  $pegawai,
                'poli' =>  $poli,
                'rekammedik' =>  $rekamMedikService->getByPoli($poli->id),
            ]
        );
    }

    public function daftar(PasienService $pasienService, PoliService $poliService, DokterService  $dokterService)
    {
        $userid = Auth::user()->id;
        $pasien = Pasien::where('user_id', $userid)->first();
        return Inertia::render('Pasien/AddRekamMedikPage', ['polis' => $poliService->all(),   'dokters' => $dokterService->all(),  'pasien' => $pasien]);
  
    }
}

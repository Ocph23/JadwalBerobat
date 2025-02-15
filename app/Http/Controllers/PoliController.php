<?php

namespace App\Http\Controllers;

use App\Models\Poli;
use Inertia\Inertia;
use App\Models\Pasien;
use App\Models\Pegawai;
use Illuminate\Http\Request;
use App\services\PoliService;
use App\services\DokterService;
use App\services\PasienService;
use Illuminate\Support\Facades\DB;
use App\services\RekamMedikService;
use Illuminate\Support\Facades\Auth;

class PoliController extends Controller
{

    public function index()
    {

        $user  =  Auth::user();
        $pegawai = Pegawai::where("user_id", $user->id)->first();
        $poli = Poli::where("pegawai_id", $pegawai->id)->first();

        $rmPasien = DB::table('rekam_mediks')
        ->groupBy('pasien_id')
        ->count();

        $rmCount = DB::table('rekam_mediks')
        ->where('poli_id',$poli->id)
        ->count();

        return Inertia::render(
            "Poli/Index",
            [
                'resep' => $rmCount,
                'pasien' => $rmPasien,
                'rekammedik' =>$rmCount,
            ]
        );
    }



    public function rekammedik(PasienService $pasienService, RekamMedikService $rekamMedikService)
    {
        $userid = Auth::user()->id;
        $pegawai = Pegawai::where('user_id', $userid)->first();
        $poli = Poli::where('pegawai_id',$pegawai->id)->first();


        return  Inertia::render(
            "Poli/RekamMedik",
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

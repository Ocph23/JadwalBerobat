<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Pasien;
use App\Models\Pegawai;
use App\Models\RekamMedik;
use App\Models\Dokter;
use App\Models\Poli;
use App\services\DokterService;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DokterController extends Controller
{
    public function index(DokterService $dokterService){
        $poli = $dokterService->getPoli();
        return Inertia::render("Dokter/Index",
        [
            'obat' => Obat::count(),
            'pasien' => Pasien::count(),
            'dokter' => Dokter::count(),
            'poli' => Poli::count(),
            'pegawai' => Pegawai::count(),
            'rekammedik' => RekamMedik::count(),
        ]);
    }
}

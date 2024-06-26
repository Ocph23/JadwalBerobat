<?php

namespace App\Http\Controllers;

use App\Models\Obat;
use App\Models\Pasien;
use App\Models\Pegawai;
use App\Models\RekamMedik;
use App\Models\Dokter;
use App\Models\Poli;
use App\services\DokterService;
use App\services\RekamMedikService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class DokterController extends Controller
{
    public function index(DokterService $dokterService)
    {
        $poli = $dokterService->getPoli();
        return Inertia::render(
            "Dokter/Index",
            [
                'obat' => Obat::count(),
                'pasien' => Pasien::count(),
                'dokter' => Dokter::count(),
                'poli' => Poli::count(),
                'pegawai' => Pegawai::count(),
                'rekammedik' => RekamMedik::count(),
            ]
        );
    }
    public function jadwalberobat()
    {
        $user = Auth::user();
            $dokter = Dokter::where('user_id',$user->id)->firstOrFail();
        return Inertia::render(
            "Dokter/JadwalBerobatPage",['dokter' => $dokter]
        );
    }

    public function jadwalberobatByDate(RekamMedikService $rekamMedikService,$dokterId, $date)
    {
        try {
          
            $results = RekamMedik::where('dokter_id', $dokterId)
                ->whereDate('konsultasi_berikut', '=', $date)
                ->get();
            foreach ($results as $key => $result) {
                $result->poli;
                $result->dokter;
                $result->pasien;
            }
            return $results->toJson();
        } catch (\Throwable $th) {
           return Redirect()->back()->withErrors(["message"=>$th->getMessage()]);
        }
    }
}

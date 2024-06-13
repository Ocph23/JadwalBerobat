<?php

namespace App\Http\Controllers;

use App\Models\Dokter;
use App\Models\Poli;
use App\services\DokterService;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;

class DokterController extends Controller
{
    public function index(DokterService $dokterService){
        $poli = $dokterService->getPoli();
        return Inertia::render("Dokter/Index",['poli'=> $poli]);
    }
}

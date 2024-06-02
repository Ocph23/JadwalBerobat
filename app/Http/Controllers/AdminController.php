<?php

namespace App\Http\Controllers;

use App\services\PoliService;
use App\services\RekamMedikService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function index(){
        return Inertia::render("Admin/Index",[]);
    }


    public function jadwalberobat(PoliService $poliService){
        return Inertia::render("Admin/JadwalBerobatPage",['polis'=>$poliService->all()]);
    }


    public function jadwalberobatByDate(RekamMedikService $rekamMedikService, $date){
        return Redirect::back()->with('success',$rekamMedikService->all());
    }

}

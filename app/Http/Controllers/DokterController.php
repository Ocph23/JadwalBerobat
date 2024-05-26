<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class DokterController extends Controller
{
    public function index(){
        return Inertia::render("Dokter/Index",[]);
    }
}

<?php

namespace App\services;

use App\Http\Requests\RekamMedikRequest;
use App\Models\RekamMedik;
use Error;
use Illuminate\Support\Facades\Log;

class RekamMedikService
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function all()
    {
        $result = RekamMedik::all();
        foreach ($result as $key => $rekamMedik) {
            $rekamMedik->dokter;
            $rekamMedik->poli;
            $rekamMedik->pasien;
        }
        return $result;
    }

    public function getById($id)
    {
        $result = RekamMedik::find($id);
        $result->poli;
        $result->dokter;
        $result->pasien;

        return $result;
    }


    public function getByDate($date)
    {
        $results = RekamMedik::where('konsultasi_berikut', $date)->get();
        foreach ($results as $key => $rekamMedik) {
            $rekamMedik->poli;
            $rekamMedik->dokter;
            $rekamMedik->pasien;
        }
        return $results->toJson();
    }




    public function getByPasienId($id)
    {
        $result = RekamMedik::Where("pasien_id", $id)->get();
        foreach ($result as $key => $rekamMedik) {
            $rekamMedik->poli;
            $rekamMedik->dokter;
        }

        return $result;
    }


    public function getByDokterId($id)
    {
        $result = RekamMedik::Where("dokter_id", $id)
        ->orderBy('tanggal')
        ->get();
        foreach ($result as $key => $rekamMedik) {
            $rekamMedik->poli;
            $rekamMedik->dokter;
            $rekamMedik->pasien;
        }

        return $result;
    }

    public function post(RekamMedikRequest $req)
    {
        try {
            $result =  RekamMedik::create([
                'tanggal' => $req['tanggal'],
                'poli_id' => $req['poli_id'],
                'pasien_id' => $req['pasien_id'],
                'dokter_id' => $req['dokter_id'],
                'konsultasi_berikut' => $req['konsultasi_berikut'],
            ]);

            Log::info("success insert".$result->id);
            return $result;
        } catch (\Throwable $th) {
            Log::info( $th->getMessage());
            throw new Error($th->getMessage());
        }
    }

    public function put(RekamMedikRequest $req, $id)
    {
        try {
            $data = RekamMedik::find($id);
            if (!$data) {
                throw new Error("Data RekamMedik Tidak Ditemukan!");
            }
            $data->tanggal = $req['tanggal'];
            $data->poli_id = $req['poli_id'];
            $data->dokter_id = $req['dokter_id'];
            $data->pasien_id = $req['pasien_id'];
            $data->konsultasi_berikut = $req['konsultasi_berikut'];
            $data->keluhan = $req['keluhan'];
            $data->penanganan = $req['penanganan'];
            $data->resep = $req['resep'];
            $data->save();
            return true;
        } catch (\Throwable $th) {
            throw new Error($th->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $data = RekamMedik::find($id);
            if (!$data)
                throw new Error("Data Tidak Ditemukan !");

            $data->delete();
            return true;
        } catch (\Throwable $th) {
            throw new Error($th->getMessage());
        }
    }
}

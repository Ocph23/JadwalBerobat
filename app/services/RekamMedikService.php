<?php

namespace App\services;

use App\Http\Requests\RekamMedikRequest;
use App\Models\RekamMedik;
use Carbon\Carbon;
use Error;
use Illuminate\Support\Facades\Http;
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

            Log::info("success insert" . $result->id);
            return $result;
        } catch (\Throwable $th) {
            Log::info($th->getMessage());
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
            $this->infoKunjunganBerikut();
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


    public function infoKunjunganBerikut()
    {
        try {
            Log::info('Start Check Kunjungan :', today());
            $data = RekamMedik::where('konsultasi_berikut', "<>", null)
            ->where(function ($q) {
                $q->where('kirimpesan1', null)
                    ->orWhere('kirimpesan2', null);
            })->get();

            $sekarang =  Carbon::create(date("Y/m/d H:s"));
            $sekarang->setTimezone("Asia/Jayapura");
            foreach ($data as $key => $rm) {
                $rm->konsultasi_berikut->setTimezone('Asia/Jayapura');
                $diff  = date_diff($sekarang, $rm->konsultasi_berikut);
                if ($diff->h <= 24 && !$rm->kirimpesan1) {
                    $sended = $this->sendWA($rm);
                    if ($sended) {
                        $rm->kirimpesan1 = $sekarang;
                        $rm->save();
                    }
                } else if ($diff->h <= 3 && !$rm->kirimpesan2) {
                    $sended = $this->sendWA($rm);
                    if ($sended) {
                        $rm->kirimpesan2 = $sekarang;
                        $rm->save();
                    }
                }
            }
        } catch (\Throwable $th) {
           Log::error($th->getMessage());
        }
    }

    public function sendWA($rm)
    {
        try {
            $pasien = $rm->pasien;
            $poli = $rm->poli;
            $pesan = 'Bapak/Ibu ' . $pasien->nama . ' Kami mengingatkan kembali untuk jadwal konsultasi pemeriksaan '
                . $poli->penyakit . ' akan dilakukan hari ini tanggal ' . $rm->konsultasi_berikut . '. terimakasih.';
            $data = [
                "userkey" => env('ZIVA_USERKEY', ''),
                "passkey" => env('ZIVA_PASSKEY'),
                "to" => $pasien->kontak,
                "message" => $pesan
            ];

            $response = Http::post('https://console.zenziva.net/wareguler/api/sendWA/', $data);
            if ($response->successful()) {
                Log::info("sended ");
                return true;
            } else {
                $users = $response->json();
                Log::info("error sended ");
                return false;
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}

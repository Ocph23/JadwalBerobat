<?php

namespace App\services;

use App\Http\Requests\RekamMedikRequest;
use App\Models\RekamMedik;
use Error;

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
        }
        return $result;
    }

    public function getById($id)
    {
        $result = RekamMedik::find($id);
        return $result;
    }


    public function post(RekamMedikRequest $req)
    {
        try {
            $result =  RekamMedik::create([
                'kode' => $req['kode'],
                'nama' => $req['nama'],
                'keterangan' => $req['keterangan'],
                'dokter_id' => $req['dokter_id'],
            ]);
            return $result;
        } catch (\Throwable $th) {
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
            $data->kode = $req['kode'];
            $data->nama = $req['nama'];
            $data->keterangan = $req['keterangan'];
            $data->dokter_id = $req['dokter_id'];
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

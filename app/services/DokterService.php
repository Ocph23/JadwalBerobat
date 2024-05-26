<?php

namespace App\services;

use App\Http\Requests\DokterRequest;
use App\Models\Dokter;
use Error;

class DokterService
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
        $result = Dokter::all();
        return $result;
    }

    public function getById($id)
    {
        $result = Dokter::find($id);
        return $result;
    }


    public function post(DokterRequest $req)
    {
        try {
            $result =  Dokter::create([
                'kode' => $req['kode'],
                'nama' => $req['nama'],
                'jk' => $req['jk'],
                'spesialis' => $req['spesialis'],
                'kontak' => $req['kontak'],
            ]);

            

            return $result;
        } catch (\Throwable $th) {
            throw new Error($th->getMessage());
        }
    }

    public function put(DokterRequest $req, $id)
    {
        try {
            $data = Dokter::find($id);
            if (!$data) {
                throw new Error("Data Dokter Tidak Ditemukan!");
            }

            $data->kode = $req['kode'];
            $data->nama = $req['nama'];
            $data->jk = $req['jk'];
            $data->spesialis = $req['spesialis'];
            $data->kontak = $req['kontak'];
            $data->save();
            return true;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function delete($id)
    {
        try {
            $data = Dokter::find($id);
            if (!$data)
                throw new Error("Data Tidak Ditemukan !");

            $data->delete();
            return true;
        } catch (\Throwable $th) {
            throw new Error($th->getMessage());
        }
    }
}

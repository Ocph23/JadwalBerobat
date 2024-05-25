<?php

namespace App\services;

use App\Http\Requests\ObatRequest;
use App\Models\Obat;
use Error;

class ObatService
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
        $result = Obat::all();
        return $result;
    }

    public function getById($id)
    {
        $result = Obat::find($id);
        return $result;
    }


    public function post(ObatRequest $req)
    {
        try {
            $result =  Obat::create([
                'kode' => $req['kode'],
                'nama' => $req['nama'],
                'merek' => $req['merek'],
                'dosis' => $req['dosis'],
                'deskripsi' => $req['deskripsi'],
                'kemasan' => $req['kemasan'],
                'exp' => $req['exp'],
            ]);

            

            return $result;
        } catch (\Throwable $th) {
            throw new Error($th->getMessage());
        }
    }

    public function put(ObatRequest $req, $id)
    {
        try {
            $data = Obat::find($id);
            if (!$data) {
                throw new Error("Data Obat Tidak Ditemukan!");
            }

            $data->kode = $req['kode'];
            $data->nama = $req['nama'];
            $data->merek = $req['merek'];
            $data->dosis = $req['dosis'];
            $data->kemasan = $req['kemasan'];
            $data->deskripsi = $req['deskripsi'];
            $data->exp = $req['exp'];
            $data->save();
            return true;
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function delete($id)
    {
        try {
            $data = Obat::find($id);
            if (!$data)
                throw new Error("Data Tidak Ditemukan !");

            $data->delete();
            return true;
        } catch (\Throwable $th) {
            throw new Error($th->getMessage());
        }
    }
}

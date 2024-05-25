<?php

namespace App\services;

use App\Http\Requests\PoliRequest;
use App\Models\Poli;
use Error;

class PoliService
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
        $result = Poli::all();
        return $result;
    }

    public function getById($id)
    {
        $result = Poli::find($id);
        return $result;
    }


    public function post(PoliRequest $req)
    {
        try {
            $result =  Poli::create([
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

    public function put(PoliRequest $req, $id)
    {
        try {
            $data = Poli::find($id);
            if (!$data) {
                throw new Error("Data Poli Tidak Ditemukan!");
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
            $data = Poli::find($id);
            if (!$data)
                throw new Error("Data Tidak Ditemukan !");

            $data->delete();
            return true;
        } catch (\Throwable $th) {
            throw new Error($th->getMessage());
        }
    }
}

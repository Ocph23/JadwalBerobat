<?php

namespace App\services;

use App\Http\Requests\PegawaiRequest;
use App\Models\Pegawai;
use Error;

class PegawaiService
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
        $result = Pegawai::all();
        return $result;
    }

    public function getById($id)
    {
        $result = Pegawai::find($id);
        return $result;
    }


    public function post(PegawaiRequest $req)
    {
        try {
            $result =  Pegawai::create([
                'kode' => $req['kode'],
                'nama' => $req['nama'],
                'jk' => $req['jk'],
                'bagian' => $req['bagian'],
                'kontak' => $req['kontak'],
            ]);
            return $result;
        } catch (\Throwable $th) {
            throw new Error($th->getMessage());
        }
    }

    public function put(PegawaiRequest $req, $id)
    {
        try {
            $data = Pegawai::find($id);
            if (!$data) {
                throw new Error("Data Pegawai Tidak Ditemukan!");
            }

            $data->kode = $req['kode'];
            $data->nama = $req['nama'];
            $data->jk = $req['jk'];
            $data->bagian = $req['bagian'];
            $data->kontak = $req['kontak'];
            $data->save();
            return true;
        } catch (\Throwable $th) {
            throw new Error($th->getMessage());
        }
    }

    public function delete($id)
    {
        try {
            $data = Pegawai::find($id);
            if (!$data)
                throw new Error("Data Tidak Ditemukan !");

            $data->delete();
            return true;
        } catch (\Throwable $th) {
            throw new Error($th->getMessage());
        }
    }
}

<?php

namespace App\services;

use App\Http\Requests\PasienRequest;
use App\Models\Pasien;
use Error;
use Illuminate\Support\Facades\Log;

class PasienService
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
        $result = Pasien::all();
        return $result;
    }

    public function getById($id)
    {
        $result = Pasien::find($id);
        return $result;
    }


    public function post(PasienRequest $req)
    {
        try {
            $result =  Pasien::create([
                'kode' => $req['kode'],
                'nama' => $req['nama'],
                'jk' => $req['jk'],
                'tempat_lahir' => $req['tempat_lahir'],
                'tanggal_lahir' => $req['tanggal_lahir'],
                'alamat' => $req['alamat'],
                'alamat' => $req['alamat'],
                'kontak' => $req['kontak'],
            ]);
            return $result;
        } catch (\Throwable $th) {
            Log::info($th->getMessage());
            throw new Error($th->getMessage());
        }
    }

    public function put(PasienRequest $req, $id)
    {
        try {
            $data = Pasien::find($id);
            if (!$data) {
                throw new Error("Data Pasien Tidak Ditemukan!");
            }

            $data->kode = $req['kode'];
            $data->nama = $req['nama'];
            $data->jk = $req['jk'];
            $data->tempat_lahir = $req['tempat_lahir'];
            $data->tanggal_lahir = $req['tanggal_lahir'];
            $data->alamat = $req['alamat'];
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
            $data = Pasien::find($id);
            if (!$data)
                throw new Error("Data Tidak Ditemukan !");

            $data->delete();
            return true;
        } catch (\Throwable $th) {
            throw new Error($th->getMessage());
        }
    }
}

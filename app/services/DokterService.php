<?php

namespace App\services;

use Error;
use App\Models\User;
use App\Models\Dokter;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\DokterRequest;
use Illuminate\Support\Facades\Hash;

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
        DB::beginTransaction();
        try {

            //create User As Dokter


            $user = User::create([
                'name' => $req->nama,
                'email' => $req->email,
                'password' => Hash::make("Password@123"),
                'role' => 'dokter',
            ]);

            $result =  Dokter::create([
                'kode' => $req['kode'],
                'nama' => $req['nama'],
                'email' => $req['email'],
                'jk' => $req['jk'],
                'spesialis' => $req['spesialis'],
                'kontak' => $req['kontak'],
                'user_id' => $user['id'],
            ]);
            
            DB::commit();
            return $result;
        } catch (\Throwable $th) {
            DB::rollBack();
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

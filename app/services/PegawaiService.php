<?php

namespace App\services;

use Error;
use App\Models\User;
use App\Models\Pegawai;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\PegawaiRequest;

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

        DB::beginTransaction();
        try {

            //create User As Pegawai
            $user = User::create([
                'name' => $req->nama,
                'email' => $req->email,
                'password' => Hash::make("Password@123"),
                'role' => 'pegawai',
            ]);

            $result =  Pegawai::create([
                'nama' => $req['nama'],
                'jk' => $req['jk'],
                'email' => $req['email'],
                'bagian' => $req['bagian'],
                'kontak' => $req['kontak'],
                'user_id' => $user->id,
            ]);
            
            DB::commit();
            return $result;
        } catch (\Throwable $th) {
            DB::rollBack();
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
            $user = User::find($data->user_id);
            $user->delete();   
            return true;
        } catch (\Throwable $th) {
            throw new Error($th->getMessage());
        }
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;
    public $timestamps = false;

    public $fillable = [
        'id',
        'kode',
        'nama',
        'jenis_kelamin',
        'status',
        'tempat_lahir',
        'tanggal_lahir',
        'kontak', 
        'alamat'
    ];
}

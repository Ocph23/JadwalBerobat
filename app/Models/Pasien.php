<?php

namespace App\Models;

use App\Casts\Kode;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;
    public $timestamps = false;

    public $fillable = [
        'id',
        'nama',
        'jk',
        'status',
        'tempat_lahir',
        'tanggal_lahir',
        'kontak', 
        'alamat'
    ];

}

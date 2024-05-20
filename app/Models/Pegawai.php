<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pegawai extends Model
{
    use HasFactory;
    public $timestamps=false;

    public $fillable =[
        'id',
        'nip',
        'nama',
       'bagian',
       'kontak'
    ];
}

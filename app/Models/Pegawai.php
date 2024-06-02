<?php

namespace App\Models;

use App\Casts\Kode;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pegawai extends Model
{
    use HasFactory;
    public $timestamps = false;

    public $fillable = [
        'id',
        'kode',
        'nama',
        'bagian',
        'kontak'
    ];

    protected function casts(): array
    {
        return [
            'kode' => Kode::class,
        ];
    }
}

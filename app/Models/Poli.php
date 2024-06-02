<?php

namespace App\Models;

use App\Casts\Kode;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Poli extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $fillable = [
        'id',
        'kode',
        'nama',
        'penyakit',
        'keterangan',
        'dokter_id'
    ];


    protected function casts(): array
    {
        return [
            'kode' => Kode::class,
        ];
    }

    public function dokter():HasOne{
        return  $this->hasOne(Dokter::class,'id',"dokter_id");
    }

}

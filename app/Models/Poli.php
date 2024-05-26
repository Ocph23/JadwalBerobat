<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Poli extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $fillable = [
        'id',
        'kode',
        'nama',
        'keterangan',
        'dokter_id'
    ];

    public function dokter():HasOne{
        return  $this->hasOne(Dokter::class,'id',"dokter_id");
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class RekamMedik extends Model
{
    use HasFactory;


    public $fillable = [
        'id',
        'kode',
        'tanggal',
        'pasien_id',
        'dokter_id',
        'poli_id',
        'konsultasi_berikut'
    ];


    public function dokter():HasOne{
        return  $this->hasOne(Dokter::class,'id',"dokter_id");
    }

    public function poli():HasOne{
        return $this->hasOne(Poli::class , 'id', 'poli_id');
    }
    
    
    public function keluhan():BelongsToMany{
        return $this->belongsToMany(Keluhan::class , 'rekam_medik_id');
    }

    public function penanganan():BelongsToMany{
        return $this->belongsToMany(Penanganan::class , 'rekam_medik_id');
    }


    public function resep():BelongsToMany{
        return $this->belongsToMany(Resep::class , 'rekam_medik_id');
    }



}

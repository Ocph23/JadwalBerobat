<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penanganan extends Model
{
    use HasFactory;

    public $fillable = [
        'id',
        'penanganan',
        'keterangan',
    ];
}

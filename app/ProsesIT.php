<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProsesIT extends Model
{
    protected $table = 'proses_it';

    protected $fillable = [
        'id_proses', 'pedagang_baru'
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meja extends Model
{
    protected $table = 'tabel';
    protected $primaryKey = 'id_tabel';
    public $timestamps = false;

    protected $fillable = [
        'tabel_number',
        'status',
    ];

}

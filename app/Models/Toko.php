<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Toko extends Model
{
    public $timestamps = false;
    public $table = 'toko';
    protected $primaryKey = 'id_toko';
    protected $fillable = [
        'nama_toko',
        'alamat',
        'telepon',
    ];
}

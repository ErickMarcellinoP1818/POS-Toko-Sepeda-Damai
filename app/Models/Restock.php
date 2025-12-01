<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restock extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $table = 'restock';
    protected $primaryKey = 'id';
    protected $fillable = [
        'total',
        'id_supplier',
        'tanggal',
        'no_trans',
        'tanggal_tempo',
        'metode',
        'tbayar',
    ];


    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'id_supplier');
    }

    public function DetailPembelian()
    {
        return $this->hasMany(\App\Models\DetailPembelian::class, 'id_pembelian', 'id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Varian extends Model
{
    public $timestamps = false;
    public $table = 'varian';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_produk',
        'nama_varian',
        'gambar',
        'status',
        'min_stok',
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk');
    }
    public function detilProduk()
    {
        return $this->hasMany(DetilProduk::class, 'id_varian');
    }
    public function totalStok()
    {
        return $this->detilProduk()->sum('stok');
    }
}

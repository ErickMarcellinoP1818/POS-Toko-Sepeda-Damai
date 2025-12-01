<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailPembelian extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $table = 'detail_pembelian';
    protected $primaryKey = 'id';

    protected $fillable = [
        'id_pembelian',
        'id_produk',
        'id_varian',
        'jumlah',
        'harga',
        'total',
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk');
    }

    public function pembelian()
    {
        return $this->belongsTo(Restock::class, 'id_pembelian');
    }

    public function varian()
    {
        return $this->belongsTo(Varian::class, 'id_varian');
    }
}

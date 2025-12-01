<?php

namespace App\Models;

use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetilProduk extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $table = 'detil_produk';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id_produk',
        'id_supplier',
        'stok',
        'harga',
        'hpp',
        'id_varian',
    ];

    public function produk()
    {
        return $this->belongsTo(Produk::class, 'id_produk');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'id_supplier');
    }

    public function varian()
    {
        return $this->belongsTo(Varian::class, 'id_varian');
    }
}

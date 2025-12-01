<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $table = 'produk';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nama',
        'Kode',
        'harga',
        'status',
        'gambar',
        'id_kategori',
        'deskripsi', 
    ];

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    public function detil_produk()
    {
        return $this->hasMany(\App\Models\DetilProduk::class, 'id_produk', 'id');
    }

    public function detil_nota()
    {
        return $this->hasMany(\App\Models\DetilNota::class, 'id_produk', 'id');
    }

    public function varian()
    {
        return $this->hasMany(Varian::class, 'id_produk', 'id');
    }
}

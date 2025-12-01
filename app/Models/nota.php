<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
class Nota extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $table = 'nota';
    protected $primaryKey = 'id';
    protected $fillable = [
        'tanggal',
        'id_kasir',
        'total',
        'bayar',
        'kembali',
        'status',
        'metode',
        'inv_num',
    ];
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($nota) {
            $nota->tanggal = $nota->tanggal ?? Carbon::today();
        });
    }

    public function kasir()
    {
        return $this->belongsTo(User::class, 'id_kasir');
    }

    public function detilnota()
    {
        return $this->hasMany(\App\Models\DetilNota::class, 'id_nota', 'id');
    }
}

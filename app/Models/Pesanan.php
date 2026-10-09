<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_pesanan',
        'nomor_kamar',
        'nama_tamu',
        'status',
        'total',
    ];

    public function items()
    {
        return $this->hasMany(PesananItem::class);
    }
}
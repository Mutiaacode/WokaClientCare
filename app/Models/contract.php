<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class contract extends Model
{
    protected $fillable = [
        'client_id',
        'product_id',
        'nomor_kontrak',
        'tipe_kontrak',
        'periode_tagihan',
        'nama_layanan',
        'tanggal_mulai',
        'tanggal_berakhir',
        'harga_layanan',
        'status',
    ];
}

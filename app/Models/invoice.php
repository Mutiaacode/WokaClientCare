<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class invoice extends Model
{
    protected $fillable = [
        'client_id',
        'contract_id',
        'nomor_invoice',
        'tanggal_terbit',
        'tanggal_jatuh_tempo',
        'subtotal',
        'pajak',
        'periode',
        'diskon',
        'total',
        'status',
        'catatan',
    ];
}

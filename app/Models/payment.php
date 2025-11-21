<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class payment extends Model
{
    protected $fillable = [
        'invoice_id',
        'jumlah_dibayar',
        'tanggal_pembayaran',
        'metode',
        'bukti_pembayaran',
        'diverifikasi_oleh',
        'tanggal_verifikasi',

    ];
}

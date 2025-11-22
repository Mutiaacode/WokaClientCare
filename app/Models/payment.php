<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
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

    public function invoice()
    {
        return $this->belongsTo(Invoice::class , 'invoice_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class , 'diverifikasi_oleh');
    }
}

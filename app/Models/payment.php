<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id',
        'jumlah_dibayar',
        'tanggal_pembayaran',
        'metode', 
        'bukti_pembayaran', 
        'diverifikasi_oleh',
        'tanggal_verifikasi'
    ];

    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

    public function verifikator()
    {
        return $this->belongsTo(User::class, 'diverifikasi_oleh');
    }
}

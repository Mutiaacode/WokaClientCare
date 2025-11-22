<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
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

    public function client()
    {
        return $this->belongsTo(Client::class , 'client_id');
    }

    public function contract()
    {
        return $this->belongsTo(Contract::class , 'contract_id');
    }

     public function payment()
    {
        return $this->hasMany(Payment::class, 'invoice_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use HasFactory;

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
        'catatan'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}

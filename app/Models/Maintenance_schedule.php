<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Maintenance_schedule extends Model
{
    protected $fillable = [
        'contract_id',
        'teknisi_id',
        'tanggal_kunjungan',
        'jam_kunjungan',
        'status',
        'catatan',
    ];

    public function contract()
    {
        return $this->belongsTo(Contract::class, 'contract_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'teknisi_id');
    }
}

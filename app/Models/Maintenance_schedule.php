<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class maintenance_schedule extends Model
{
    protected $fillable = [
        'contract_id',
        'teknisi_id',
        'tanggal_kunjungan',
        'jam_kunjungan',
        'status',
        'catatan',
    ];
}

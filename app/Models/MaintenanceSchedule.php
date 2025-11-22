<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class MaintenanceSchedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'contract_id', 
        'teknisi_id', 
        'tanggal_kunjungan',
        'jam_kunjungan', 
        'status', 
        'catatan'
    ];

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }

    public function teknisi()
    {
        return $this->belongsTo(User::class, 'teknisi_id');
    }
}

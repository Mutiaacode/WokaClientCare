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

    protected $appends = ['client_action'];

    // Accessor kolom virtual
    public function getClientActionAttribute()
    {
        // Logika: kalau status default, maka client belum pilih
        if ($this->status == 'dijadwalkan') {
            return 'pending'; // tombol aksi harus muncul
        }

        return 'done'; // aksi disembunyikan
    }
    
    public function contract()
    {
        return $this->belongsTo(Contract::class, 'contract_id');
    }

    public function teknisi()
    {
        return $this->belongsTo(User::class, 'teknisi_id');
    }
}

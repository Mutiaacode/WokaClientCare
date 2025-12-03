<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'staff_id',
        'produk_id',
        'nomor_kontrak',
        'tipe_kontrak',
        'periode_tagihan',
        'nama_layanan',
        'tanggal_mulai',
        'tanggal_berakhir',
        'harga_layanan',
        'status',
        'file_kontrak',
        'catatan'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'produk_id');
    }

    public function staff()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }


    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    public function maintenanceSchedules()
    {
        return $this->hasMany(MaintenanceSchedule::class);
    }
}

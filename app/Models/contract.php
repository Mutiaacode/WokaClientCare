<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $fillable = [
        'client_id',
        'product_id',
        'nomor_kontrak',
        'tipe_kontrak',
        'periode_tagihan',
        'nama_layanan',
        'tanggal_mulai',
        'tanggal_berakhir',
        'harga_layanan',
        'status',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class , 'client_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class , 'product_id');
    }

    public function invoic()
    {
        return $this->hasMany(Invoice::class, 'contract_id');
    }
    public function MaintenanceSchedule()
    {
        return $this->hasMany(Maintenance_schedule::class, 'contract_id');
    }
    public function ticket()
    {
        return $this->hasMany(Ticket::class, 'contract_id');
    }
}

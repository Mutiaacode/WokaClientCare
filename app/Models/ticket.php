<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id', 
        'contract_id', 
        'staff_id', 
        'teknisi_id',
        'judul', 
        'deskripsi',
         'prioritas', 
         'status', 
         'lampiran'
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }

    public function staff()
    {
        return $this->belongsTo(User::class, 'staff_id');
    }

    public function teknisi()
    {
        return $this->belongsTo(User::class, 'teknisi_id');
    }

    public function logs()
    {
        return $this->hasMany(TicketLog::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'client_id',
        'contract_id',
        'staff_id',
        'teknisi_id',
        'judul',
        'deskripsi',
        'prioritas',
        'status',
        'lampiran',
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'client_id');
    }
    public function contact()
    {
        return $this->belongsTo(Contract::class, 'contract_id');
    }
    public function userS()
    {
        return $this->belongsTo(User::class, 'straff_id');
    }
    public function userT()
    {
        return $this->belongsTo(User::class, 'teknisi_id');
    }
    public function ticketLog()
    {
        return $this->hasMany(Ticket_log::class, 'ticket_id');
    }
}

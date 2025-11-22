<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket_log extends Model
{
    protected $fillable = [
        'ticket_id',
        'user_id',
        'status_sebelumnya',
        'status_baru',
        'pesan',
        'lampiran',
    ];

     public function ticket()
    {
        return $this->belongsTo(Ticket::class, 'ticket_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

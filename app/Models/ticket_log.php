<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ticket_log extends Model
{
    protected $fillable = [
        'ticket_id',
        'user_id',
        'status_sebelumnya',
        'status_baru',
        'pesan',
        'lampiran',
    ];
}

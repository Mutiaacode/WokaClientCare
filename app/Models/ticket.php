<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ticket extends Model
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
}

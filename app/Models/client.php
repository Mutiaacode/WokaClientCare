<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class client extends Model
{
    protected $fillable = [
        'user_id',
        'nama_usaha',
        'nomor_hp',
        'alamat',
    ];
}

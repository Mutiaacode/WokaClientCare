<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'nama_usaha', 'nomor_hp', 'alamat'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
  
}

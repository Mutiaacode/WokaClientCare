<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name', 'email', 'password', 'role', 'phone'
    ];

    public function client()
    {
        return $this->hasOne(Client::class , 'user_id');
    }

    public function ticketS()
    {
        return $this->hasMany(Ticket::class , 'staff_id');
    }

    public function ticketT()
    {
        return $this->hasMany(Ticket::class , 'teknisi_id');
    }
}

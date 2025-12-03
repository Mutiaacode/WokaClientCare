<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'phone'
    ];

    public function client()
    {
        return $this->hasOne(Client::class);
    }

    public function ticketsReviewed()
    {
        return $this->hasMany(Ticket::class, 'staff_id');
    }

    public function contractsHandled()
    {
        return $this->hasMany(Contract::class, 'staff_id');
    }

    public function ticketsAssigned()
    {
        return $this->hasMany(Ticket::class, 'teknisi_id');
    }

    public function ticketLogs()
    {
        return $this->hasMany(TicketLog::class);
    }

    public function paymentsVerified()
    {
        return $this->hasMany(Payment::class, 'diverifikasi_oleh');
    }
}

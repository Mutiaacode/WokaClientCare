<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_produk', 
        'deskripsi', 
        'harga_default'
    ];

    public function contracts()
    {
        return $this->hasMany(Contract::class, 'produk_id');
    }
}

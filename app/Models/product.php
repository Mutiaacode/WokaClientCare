<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'nama_product',
        'deskripsi',
        'harga_default',

    ];

    public function contracts()
    {
        return $this->hasMany(Contract::class , 'product_id');
    }
}

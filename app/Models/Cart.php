<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
        'inventory_id',
        'quantity',
    ];

    // Relasi ke Inventory
    public function inventory()
    {
        return $this->belongsTo(Inventory::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_number',     // Tambahkan kolom invoice_number di sini
        'user_id',
        'shipping_address',
        'postal_code',
        'total_price',
    ];
}

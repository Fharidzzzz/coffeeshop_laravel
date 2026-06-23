<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'number', 'user_id', 'product_id', 'quantity', 'total_price', 'status', 'snap_token'
    ];

    // Relasi untuk tahu menu kopi mana yang dibeli
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
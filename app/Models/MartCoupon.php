<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MartCoupon extends Model
{
    use HasFactory;

    public function cartItems()
    {
        return $this->belongsToMany(CartItem::class);
    }

    public function orderItems()
    {
        return $this->belongsToMany(OrderItem::class);
    }
}

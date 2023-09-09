<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
/**
 * pa make:model CartItem -r
 */
class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'price',
        'quantity',
        'total',
        'mart_coupon_id',
        'discount_amount'
    ];

    public function product() {
        return $this->belongsTo(Product::class);
    }

    public function cart() {
        return $this->belongsTo(Cart::class);
    }

    public function martCoupon()
    {
        return $this->hasOne(MartCoupon::class);
    }
}

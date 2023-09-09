<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * pa make:model Account -mr
 */
class Balance extends Model
{
    use HasFactory;

    protected $fillable = [
        'trade_amount',
        'deposit',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

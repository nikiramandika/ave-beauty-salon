<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartItem extends Model
{
    protected $fillable = ['cart_id', 'item_type', 'item_id', 'name', 'price', 'quantity'];

    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }
}


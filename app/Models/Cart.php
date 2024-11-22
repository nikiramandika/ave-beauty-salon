<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cart extends Model
{
    protected $primaryKey = 'cart_id';
    protected $fillable = ['user_id', 'is_active'];

    public $incrementing = true;

    public $timestamps = false;


    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    // Di dalam model User
    public function cart()
    {
        return $this->hasOne(Cart::class);
    }

    public function items()
    {
        return $this->hasMany(CartItem::class, 'cart_id');
    }
}


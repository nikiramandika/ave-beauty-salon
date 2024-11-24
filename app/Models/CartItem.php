<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartItem extends Model
{
    protected $primaryKey = 'cart_item_id';
    protected $fillable = ['cart_id', 'product_id','detail_id', 'quantity','size'];
    public $timestamps = false;


    public function cart()
    {
        return $this->belongsTo(Cart::class);
    }

    // Model CartItem
// Model CartItem
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'product_id');
    }

    public function productDetail()
    {
        return $this->belongsTo(ProductDetail::class, 'detail_id', 'detail_id');
    }


}


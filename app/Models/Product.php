<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $primaryKey = 'product_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'product_id',
        'product_name',
        'product_slug',
        'price',
        'category_id',
        'is_active'
    ];

    // Definisikan relasi ke ProductDetail
    public function details()
    {
        return $this->hasOne(ProductDetail::class, 'product_id', 'product_id');
    }

    // Definisikan relasi ke ProductDescription
    public function description()
    {
        return $this->hasOne(ProductDescription::class, 'product_id', 'product_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id', 'category_id');
    }
}

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
        'category_id',
        'is_active'
    ];

    // Definisikan relasi ke ProductDetail
    public function details()
    {
        return $this->hasMany(ProductDetail::class, 'product_id', 'product_id');
    }
    public function getPriceRangeAttribute()
    {
        if ($this->details->isEmpty()) {
            return null; // Tidak ada detail, tidak ada harga
        }

        $minPrice = $this->details->min('price'); // Harga minimum
        $maxPrice = $this->details->max('price'); // Harga maksimum

        // Jika harga minimum dan maksimum sama, hanya tampilkan satu harga
        if ($minPrice == $maxPrice) {
            return "Rp" . number_format($minPrice, 0, ',', '.');
        }

        // Tampilkan rentang harga
        return "Rp" . number_format($minPrice, 0, ',', '.') . " - Rp" . number_format($maxPrice, 0, ',', '.');
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

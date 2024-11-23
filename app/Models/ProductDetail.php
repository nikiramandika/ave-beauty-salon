<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    use HasFactory;

    protected $table = 'product_details';
    protected $primaryKey = 'detail_id';

    public $timestamps = false; // Nonaktifkan timestamps


    protected $fillable = [
        'product_id',
        'product_stock',
        'size',
        'price'
    ];

    
}

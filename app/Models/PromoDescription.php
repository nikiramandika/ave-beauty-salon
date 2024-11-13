<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromoDescription extends Model
{
    use HasFactory;

    protected $table = 'promo_descriptions';
    protected $primaryKey = 'description_id';
    public $timestamps = false; // Nonaktifkan timestamps
    public $incrementing = true;
    protected $fillable = [
        'promo_id',
        'description',
        'promo_image',
    ];

    // Relationship with Promos (one-to-one, inverse)
    public function promo()
    {
        return $this->belongsTo(Promo::class, 'promo_id');
    }
}

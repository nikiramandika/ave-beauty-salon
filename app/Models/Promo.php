<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    use HasFactory;

    protected $table = 'promos';
    protected $primaryKey = 'promo_id';

    public $incrementing = true;
    protected $fillable = [
        'promo_name',
        'promo_slug',
        'original_price',
        'promo_price',
        'start_date',
        'end_date',
        'is_active',
        'treatment_id',
    ];

    // Relationship with Treatment (many-to-one)
    public function treatment()
    {
        return $this->belongsTo(Treatment::class, 'treatment_id');
    }

    // Relationship with PromoDescription (one-to-one)
    public function description()
    {
        return $this->hasOne(PromoDescription::class, 'promo_id');
    }

    // Model Promo
    public function treatments()
    {
        return $this->belongsToMany(Treatment::class, 'promo_treatment', 'promo_id', 'treatment_id');
    }


}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Treatment extends Model
{
    use HasFactory;

    protected $table = 'treatments';
    protected $primaryKey = 'treatment_id';

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'treatment_id',
        'treatment_name',
        'treatment_slug',
        'price',
        'is_active',
    ];

    // Relationship with TreatmentDescription (if you have this model)
    public function description()
    {
        return $this->hasOne(TreatmentDescription::class, 'treatment_id');
    }

    // Relationship with Promos (one-to-many)
    public function promos()
    {
        return $this->belongsToMany(Promo::class, 'promo_treatment', 'treatment_id', 'promo_id');
    }
    
}

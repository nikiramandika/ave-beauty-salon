<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TreatmentDescription extends Model
{
    use HasFactory;

    protected $table = 'treatment_descriptions';
    public $timestamps = false; // Nonaktifkan timestamps

    protected $fillable = [
        'treatment_id',
        'treatment_image',
        'description',
        'duration'
    ];



    public function treatment()
    {
        return $this->belongsTo(Treatment::class, 'treatment_id');
    }
}

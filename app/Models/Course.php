<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $table = 'courses';
    protected $primaryKey = 'course_id';


    protected $fillable = [
        'course_name',
        'course_slug',
        'price',
        'sessions',
        'is_active'
    ];

    // Define a one-to-one relationship with CourseDescription
    public function description()
    {
        return $this->hasOne(CourseDescription::class, 'course_id');
    }


    // Relationship with CourseRegistration (one-to-many)
    public function registrations()
    {
        return $this->hasMany(CourseRegistration::class, 'course_id');
    }
}

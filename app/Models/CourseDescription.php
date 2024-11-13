<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseDescription extends Model
{
    use HasFactory;

    protected $table = 'course_descriptions';
    protected $primaryKey = 'description_id';

    protected $fillable = [
        'course_id',
        'free_items',
        'course_image',
        'benefits',
        'description' // New field added here
    ];

    public $timestamps = false; // if you don’t have created_at and updated_at columns

    // Define the inverse relationship with Course
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}

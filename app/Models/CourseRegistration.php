<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseRegistration extends Model
{
    use HasFactory;

    protected $table = 'course_registrations';
    public $timestamps = false;

    protected $fillable = [
        'course_id',
        'user_id',
        'start_date',
        'end_date',
        'sessions_completed',
        'status'
    ];

    // Relationship with Course (many-to-one)
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
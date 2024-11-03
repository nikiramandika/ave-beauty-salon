<?php

// app/Models/Category.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'category_id';
    public $timestamps = false;

    protected $fillable = [
        'category_name',
        'category_slug',
        'category_image'
    ];

    // Custom method to generate slug
    public static function generateSlug($name)
    {
        return strtolower(str_replace(' ', '-', $name));
    }
}
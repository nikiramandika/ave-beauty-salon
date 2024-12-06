<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama_depan',
        'nama_belakang',
        'phone',
        'email',
        'password',
        'role',
        'is_active'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'created_at' => 'datetime',
            'updated_at' => 'datetime',
            'is_active' => 'boolean'
        ];
    }
    public function cart()
    {
        return $this->hasOne(Cart::class, 'user_id')->where('is_active', true);
    }

    public function member()
    {
        return $this->hasOne(Member::class, 'user_id', 'id'); // Relasi ke tabel members
    }

    // App\Models\User.php
    public function courseRegistrations()
    {
        return $this->hasMany(CourseRegistration::class, 'user_id');
    }

    /**
     * The attributes that should be cast to enum.
     *
     * @var array
     */
    protected $enumCasts = [
        'role' => \App\Enums\UserRole::class,
    ];

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Member extends Model
{
    use HasFactory, HasUuids;

    protected $table = 'members';
    protected $primaryKey = 'member_id';
    public $incrementing = false;
    protected $keyType = 'string';

    /**
     * Custom timestamps
     */
    const CREATED_AT = 'joined_date';
    const UPDATED_AT = 'updated_at';

    protected $fillable = [
        'user_id',
        'membership_number',
        'points',
        'joined_date',
        'cashier_id',
        'is_active',
    ];

    protected $casts = [
        'joined_date' => 'datetime',
        'is_active' => 'boolean',
        'points' => 'integer',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function pointRedemptions()
    {
        return $this->hasMany(PointRedemption::class, 'member_id', 'member_id');
    }
}

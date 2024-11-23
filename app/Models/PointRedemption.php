<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointRedemption extends Model
{
    use HasFactory;

    protected $table = 'point_redemptions';

    protected $primaryKey = 'redemption_id';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'redemption_id',
        'member_id',
        'points_used',
        'reward_type',
        'discount_amount',
        'redemption_date',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class, 'member_id', 'member_id');
    }
}

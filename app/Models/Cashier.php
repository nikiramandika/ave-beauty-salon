<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cashier extends Model
{
    use HasFactory,HasUuids;

    // Specify the table name if it's not the plural of the model name
    protected $table = 'cashiers';

    // Specify the primary key if it's not 'id'
    protected $primaryKey = 'cashier_id';

    // Disable timestamps if you do not have 'created_at' and 'updated_at' columns
    public $timestamps = false;

    protected $fillable = [
        'user_id',
        'is_active',
    ];

    // Define relationships if necessary
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Refund extends Model
{
    use HasFactory;

    protected $fillable = [
        'refund_id',
        'invoice_id',
        'user_refund_file',
        'admin_refund_file',
        'refund_reason',
        'refund_status',
    ];
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InvoiceSummary extends Model
{
    use HasFactory;

    protected $table = 'invoice_summary';

    // Definisikan relasi dengan Course dan User
    public function course()
    {
        return $this->belongsTo(Course::class);
    }

}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionItem extends Model
{
    use HasFactory;

    // Specify the table name if it's not the plural form of the model name
    protected $table = 'transaction_items';

    // Define the primary key column if it's not 'id'
    protected $primaryKey = 'item_id';

    // Specify the fields that can be mass assigned
    protected $fillable = [
        'transaction_id',
        'product_id',
        'treatment_id',
        'price',
        'quantity',
        'subtotal',
        'order_status'
    ];

    // Define the relationship to the Transaction model (inverse of one-to-many)
    public function transaction()
    {
        return $this->belongsTo(Transaction::class, 'transaction_id', 'transaction_id');
    }
}

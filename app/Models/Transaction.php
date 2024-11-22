<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    // Specify the table name if it's not the plural form of the model name
    protected $table = 'transactions';

    // Define the primary key column if it's not 'id'
    protected $primaryKey = 'transaction_id';

    // Specify the fields that can be mass assigned
    protected $fillable = [
        'user_id',
        'cashier_id',
        'transaction_date',
        'total_amount',
        'points_earned',
        'payment_method',
        'status'
    ];

    // Set the date fields to be automatically cast to Carbon instances
    protected $dates = ['transaction_date'];

    // Define the relationship to the TransactionItem model (one-to-many)
    public function transactionItems()
    {
        return $this->hasMany(TransactionItem::class, 'transaction_id', 'transaction_id');
    }
}

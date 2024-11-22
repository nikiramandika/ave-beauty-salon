<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellingInvoiceDetail extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'selling_invoice_details';

    // Primary Key
    protected $primaryKey = 'invoice_detail_id';

    // Kolom yang dapat diisi
    protected $fillable = [
        'invoice_detail_id',
        'invoice_id',
        'product_name',
        'treatment_name',
        'price',
        'quantity',
        'subtotal',
    ];

    // Timestamps (jika tabel tidak menggunakan created_at dan updated_at)
    public $timestamps = false;

    // Relasi ke SellingInvoice
    public function invoice()
    {
        return $this->belongsTo(SellingInvoice::class, 'invoice_id', 'selling_invoice_id');
    }
}

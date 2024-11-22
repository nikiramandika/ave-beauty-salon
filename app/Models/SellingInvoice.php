<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellingInvoice extends Model
{
    use HasFactory;

    // Nama tabel
    protected $table = 'selling_invoices';

    // Primary Key
    protected $primaryKey = 'selling_invoice_id';

    // Tipe Primary Key
    public $incrementing = false;
    protected $keyType = 'string';

    // Kolom yang dapat diisi
    protected $fillable = [
        'selling_invoice_id',
        'invoice_code',
        'cashier_id',
        'user_id',
        'recipient_name',
        'recipient_phone',
        'recipient_file',
        'recipient_address',
        'recipient_request',
        'recipient_bank',
        'recipient_payment',
        'order_date',
        'order_complete',
        'refund_file',
        'order_status',
    ];

    // Timestamps (jika tabel tidak menggunakan created_at dan updated_at)
    public $timestamps = false;

    // Relasi ke SellingInvoiceDetail
    public function details()
    {
        return $this->hasMany(SellingInvoiceDetail::class, 'invoice_id', 'selling_invoice_id');
    }
}

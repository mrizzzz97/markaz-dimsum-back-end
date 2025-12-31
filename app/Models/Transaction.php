<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Transaction extends Model
{
    protected $fillable = [
        'invoice_code',
        'customer_name',
        'payment_method',
        'total',
        'paid',
        'change',
        'cashier_id',
    ];

    // detail item transaksi
    public function items()
    {
        return $this->hasMany(TransactionItem::class);
    }

    // relasi kasir (user login)
    public function cashier()
    {
        return $this->belongsTo(User::class, 'cashier_id');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = [
        'user_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'shipping_address',
        'total_price',
    ];

    public function items()
    {
        return $this->hasMany(TransactionItem::class, 'transaction_id', 'id');
    }

    public function payment()
    {
        return $this->hasOne(TransactionPayment::class, 'transaction_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function hasPayment()
    {
        return $this->payment()->exists();
    }
}

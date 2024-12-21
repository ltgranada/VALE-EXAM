<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'shipping_address',
        'total_price',
        'status', // Add the status field to the fillable array
    ];

    // Relationship to retrieve items associated with the transaction
    public function items(): HasMany
    {
        return $this->hasMany(TransactionItem::class, 'transaction_id', 'id');
    }

    // Relationship to retrieve the user associated with the transaction
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // Relationship to retrieve payments associated with the transaction
    public function payments()
    {
        return $this->hasMany(TransactionPayment::class, 'transaction_id', 'id');
        return $this->hasMany(Payment::class);
    }
}
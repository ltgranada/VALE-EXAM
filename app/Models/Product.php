<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    // Specify the fields that can be mass assigned
    protected $fillable = ['name', 'price', 'description', 'stock'];

    // Optionally, you can define relationships here if needed
    // For example, if you have a relationship with a Cart model
    public function carts()
    {
        return $this->hasMany(Cart::class);
    }
}
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Medicine extends Model
{
    use HasFactory;

    // Define the fillable properties
    protected $fillable = [
        'name',
        'price',
        'description',
        'image', // Add image to the fillable properties
    ];
}
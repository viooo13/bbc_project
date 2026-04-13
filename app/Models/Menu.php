<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'category',
        'image',
        'status',
        'is_recommended',
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'is_recommended' => 'boolean',
    ];
}

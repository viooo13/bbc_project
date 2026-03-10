<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'customer_name',
        'rating',
        'content',
        'admin_reply',
    ];

    protected $casts = [
        'rating' => 'integer',
    ];
}

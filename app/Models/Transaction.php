<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'transaction_status',
        'transaction_info',
    ];

    protected $casts = [
        'transaction_info' => 'array'
    ];
}

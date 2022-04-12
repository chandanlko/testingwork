<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerActivity extends Model
{
    use HasFactory;
    protected $fillable = [
        'term',
        'os',
        'ip_address',
        'type',
        'customer_id'
    ];
}

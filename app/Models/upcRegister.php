<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class upcRegister extends Model
{
    use HasFactory;
    protected $fillable=[
        'upc',
        'image',
        'customer_id'
    ];
}

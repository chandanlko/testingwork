<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'firstname',
        'lastname',
        'email',
        'password',
        'date_of_birth',
        'gender',
        'zip_code',
        'is_subscribed',
        'device_id',
        'phone_number'
    ];

  
}

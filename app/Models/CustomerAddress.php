<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerAddress extends Model
{
    use HasFactory;
    protected $fillable = [
        'country_code',
        'street',
        'telephone',
        'postcode',
        'city',
        'firstname',
        'lastname',
        'customer_id',
        'default_shipping',
        'default_billing',
        ''
    ];

}

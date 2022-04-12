<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerValuePack extends Model
{
    use HasFactory;
    protected $fillable=[
        'value_pack_1',
        'value_pack_2',
        'value_pack_3',
        'customer_id',
    ];
}

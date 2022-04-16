<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;
    protected $fillable=[
        'product_desc',
        'product_name',
        'default_price',
        'status',
        'image',
        'category_id',
        'subcatgeory_id'

    ];
}

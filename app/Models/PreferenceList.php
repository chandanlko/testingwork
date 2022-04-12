<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreferenceList extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'sku',
        'brand_id',
        'parent_id',
        'type'
        
    ];
}

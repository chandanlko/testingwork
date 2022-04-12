<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $primaryKey = 'productId';

    public function categories()
    {
        return $this->hasMany('App\Models\CatHierarchy', 'category_id', 'category_id');
    }
    public function brand(){
        return $this->belongsTo('App\Models\Brand','brand_id', 'brand_id');
    }
}

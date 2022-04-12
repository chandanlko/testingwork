<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CatHierarchy extends Model
{

    use HasFactory;
   
    protected $primaryKey = 'category_id';

     public function product()
    {
        return $this->hasMany('App\Models\Product', 'category_id', 'category_id');
    }
    

}

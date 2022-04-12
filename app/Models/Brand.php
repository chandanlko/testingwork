<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    protected $primaryKey = 'brand_id';
    public function preferenceList()
    {
        return $this->hasMany('App\Models\PreferenceList', 'brand_id', 'brand_id');
    }

    public function parentModel(){
        return $this->belongsTo('App\Models\ParentModel', 'parent_id', 'parent_id');
    }
    public function product(){
        return $this->hasMany('App\Models\Product', 'brand_id', 'brand_id');
    }
}

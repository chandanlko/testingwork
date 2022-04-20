<?php

namespace App\Helpers;
use Illuminate\Support\Facades\DB;

class ProductHelper
{
    static public function gettheproductvariation($productid){      return DB::table('product_variation')->where('product_id', $productid)->get();
    
    }
    static public function zipcodes($productid){
          return DB::table('product_zip')->where('product_id', $productid)->get();
    }
    
}

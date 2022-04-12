<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BrandController extends Controller
{
    public function insertdata(){
       // echo "<pre>";
        $users = DB::table('temp_product2')->get()->toArray();
        foreach($users as $uservaluees){

            $brands=DB::table('brands')->select('brand_id')->where('brand_name',$uservaluees->newBrand)->get()->toArray();
            
            $Category=DB::table('cat_hierarchies')->select('categoryId')
                        ->where('category_name',$uservaluees->Category)
                        ->where('sub_category1',$uservaluees->SubCategory1)
                        ->where('sub_category2',$uservaluees->SubCategory2)
                        ->get()->toArray();
            $newarray=[
                'product_desc'=>$uservaluees->PRODUCT,
                'upc_code'=>$uservaluees->UPC,
                'brand_id'=>isset($brands[0]->brandId)?$brands[0]->brandId:"",
                'category_id'=>$Category[0]->categoryId,
            ];
                //print_r($newarray);
            DB::table('products')->insert($newarray);

        }
    }
}

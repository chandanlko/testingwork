<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $users = DB::table('temp_product2')->get()->toArray();
        foreach($users as $uservaluees){
          if(!empty($uservaluees->PRODUCT) || $uservaluees->PRODUCT !='' || $uservaluees->PRODUCT !=null) {
            $brands=DB::table('brands')->select('brand_id')->where('brand_name',$uservaluees->newBrand)->first();
            
            $Category=DB::table('cat_hierarchies')->select('category_id')
                        ->where('category_name',$uservaluees->Category)
                        ->where('sub_category1',$uservaluees->SubCategory1)
                        ->where('sub_category2',$uservaluees->SubCategory2)
                        ->first();
            
            $newarray=[
                'product_desc'=>$uservaluees->PRODUCT,
                'upc_code'=>$uservaluees->UPC,
                'brand_id'=>isset($brands->brand_id)?$brands->brand_id:null,
                'category_id'=>isset($Category->category_id)?$Category->category_id:null,
            ];
            DB::table('products')->insert($newarray);
          }

           
        
    }
  }
}

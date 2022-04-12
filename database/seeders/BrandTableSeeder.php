<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brands= DB::table('temp_product2')->select('newBrand','newParent')->distinct('newBrand')->get();
          foreach($brands as $values){
            $parentdata=DB::table('parents')->select('parent_id')->where('parent_name',$values->newParent)->first();
            $data=['parent_id'=>$parentdata->parent_id,'brand_name'=>$values->newBrand];
            DB::table('brands')->insert($data);
          }
          
    }
}

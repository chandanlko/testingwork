<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CatHierarchy;
use Illuminate\Support\Facades\DB;
class CatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $tem_product= DB::table('temp_product2')->get();
          foreach($tem_product as $values){
            $check_available_category=DB::table('cat_hierarchies')->where(
              [
                'category_name'=>$values->Category,
                'sub_category1'=>$values->SubCategory1,
                'sub_category2'=>$values->SubCategory2
              ]
            )->get()->count();
            if($check_available_category<1){
              $data=   [
                'category_name'=>$values->Category,
                'sub_category1'=>$values->SubCategory1,
                'sub_category2'=>$values->SubCategory2
              ];
              CatHierarchy::create($data);
            }
           
          }
    }
}

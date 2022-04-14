<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ParentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $parents= DB::table('temp_product2')->select('newParent')->distinct('newParent')->get();

          foreach($parents as $keys=>$valuess){
            if(!empty($valuess->newParent)){
                 $data=['parent_name'=>$valuess->newParent];
                DB::table('parents')->insert($data);
            }
           
          }
          
    }
}

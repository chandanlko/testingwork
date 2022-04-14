<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Banner;
use Illuminate\Support\Facades\DB;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
          $banners= DB::table('temp_product2')->select('BANNER')->distinct('BANNER')->get();
          foreach($banners as $bannervalue){
            $data=[
              'banner_name'=>$bannervalue->BANNER
            ];
            Banner::create($data);
          }
          
    }
}

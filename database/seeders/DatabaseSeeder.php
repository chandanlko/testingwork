<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\BannerSeeder;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(ParentSeeder::class);
        $this->call(BannerSeeder::class);
        $this->call(BrandTableSeeder::class);
        $this->call(CatSeeder::class);
        $this->call(ValuePacks::class);
        $this->call(ProductSeeder::class);
        $this->call(ValuePackScoreSeeder::class);
    }
}

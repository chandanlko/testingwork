<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ValuePacks extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $values_packs = array(
            array('values_pack_id' => '1','values_pack_name' => 'Conservative','created_at' => NULL,'updated_at' => NULL),
            array('values_pack_id' => '2','values_pack_name' => 'Liberal','created_at' => NULL,'updated_at' => NULL),
            array('values_pack_id' => '3','values_pack_name' => 'America First','created_at' => NULL,'updated_at' => NULL),
            array('values_pack_id' => '4','values_pack_name' => 'Save The Planet','created_at' => NULL,'updated_at' => NULL),
            array('values_pack_id' => '5','values_pack_name' => 'Made in USA','created_at' => NULL,'updated_at' => NULL),
            array('values_pack_id' => '6','values_pack_name' => 'LGBTQ+','created_at' => NULL,'updated_at' => NULL),
            array('values_pack_id' => '7','values_pack_name' => 'Support Veterans','created_at' => NULL,'updated_at' => NULL),
            array('values_pack_id' => '8','values_pack_name' => 'BLM','created_at' => NULL,'updated_at' => NULL),
            array('values_pack_id' => '9','values_pack_name' => 'Non-Political','created_at' => NULL,'updated_at' => NULL)
          );
          
        foreach($values_packs as $valuess){
            DB::table('values_packs')->insert($valuess);
        }
    }
}

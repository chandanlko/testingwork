<?php

namespace App\GraphQL\Queries;
 
use App\Models\ValuesPack;

class ValuesPackData
{ 
    /** Used for static Values API
     * @param  null   $args
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        $getdata=ValuesPack::get();
        if(!empty($getdata)){
            foreach($getdata as $keys=>$valuespack){
                $getdata[$keys]['name']=$valuespack->values_pack_name;
            }
        }
        $array['name']=$getdata;      
        return $array;
    }
}

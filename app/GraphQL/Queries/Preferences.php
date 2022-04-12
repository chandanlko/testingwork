<?php

namespace App\GraphQL\Queries;

use App\Models\PreferenceList;
use App\Models\Brand;
use App\Models\ParentModel;
use Illuminate\Support\Facades\Log;


class Preferences
{
    /** product search search key word and sku
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
       try{
           $customerid=$args['customer_id'];
           $responsedata=PreferenceList::where('customer_id',$customerid)->get()->toArray();
           if(!empty($responsedata)){
               foreach($responsedata as $key=>$values){
                    $brand=Brand::where('brand_id',$values['brand_id'])->first();
                    $Parent=ParentModel::where('parent_id',$values['parent_id'])->first();
                    $responsedata[$key]['brand']=$brand['brand_name'];
                    $responsedata[$key]['parent']=$Parent['parent_name'];
                    $responsedata[$key]['primary_id']=$values['id'];
               }
               return ['allRecords'=>$responsedata];
           }

          }
         catch (\Exception $e) {
            Log::info('Error in Graphql\Queries\Products ', ['line'=>__LINE__,'error'=>$e->getMessage()]);
            return  __LINE__.$e->getMessage();
        }
           
       
    }
}

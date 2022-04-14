<?php

namespace App\GraphQL\Queries;

use App\Models\PreferenceList;
use App\Models\Brand;
use App\Models\ParentModel;
use App\Helpers\LogHelper;


class Preferences
{
    /** product search search key word and sku
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
       try{
        $response = [];
        $id = 0;
        $id = LogHelper::saveLogData($args['customer_id'], $args, $response, 'Preferences');
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
                $response= ['error'=>0,'code'=>200,'comment'=>'Data Fetched','allRecords'=>$responsedata];
           }
           LogHelper::updateLogData($id, $args['customer_id'], $args, $response, 'Preferences');
           return $response;

        } catch (\Exception $e) { // In case of exception
            $errordata = ['line' => $e->getLine(), 'error' => $e->getMessage()];
            LogHelper::saveErrorLog($id, $errordata); // Save error in table
            return $response = ['code' => 500, 'comment' => "Something went wrong. Please try again"];
          } catch (\Throwable $e) { // In case of fatal error
            $errordata = ['line' => $e->getLine(), 'error' => $e->getMessage()];
            LogHelper::saveErrorLog($id, $errordata); // Save error in table
            return $response = ['code' => 500, 'comment' => "Something went wrong. Please try again"];
          }
           
       
    }
}

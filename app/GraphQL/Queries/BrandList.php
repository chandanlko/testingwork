<?php

namespace App\GraphQL\Queries;
use App\Models\GetScore;
use App\Models\Brand;
use App\Helpers\LogHelper;

class BrandList
{
    /**
     * @param  null  $_used for to get the brandlist Data on basis of parent id
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
       
        try{
            $res = [];
            $id = 0;
            $id = LogHelper::saveLogData($args['customer_id'], $args, $res, 'BrandList');
            $BrandListData=Brand::where('parent_id',$args['parent_id'])->get();
            $score=GetScore::scoringbyparent_id($args['customer_id'],$args['parent_id']);
            if($BrandListData->count()>0){
                foreach($BrandListData as $valuesOfBrand){
                    $res[]=[
                            'brandname'=>$valuesOfBrand->brand_name,
                            'primary_id'=>$valuesOfBrand->brand_id,
                            'upc_count'=>$valuesOfBrand->product->count()
                    ];
                }
                $collection = collect($res);
                $sorted = $collection->sortBy(['upc_count','brandname']);
                $res=array_reverse($sorted->toArray());
                $result=['score'=>($score)?round($score,6):0,'comment'=>"Data Fetched Succesfully", 'code'=>200, 'details'=>$res];
            }
            else{
                $result=['comment'=>"No Data Found", 'code'=>202, 'details'=>$res];
            }
            LogHelper::updateLogData($id, $args['customer_id'], $args, $result, 'BrandList');
            return  $result;
        } catch (\Exception $e) { // In case of exception
            $errordata = ['line' => $e->getLine(), 'error' => $e->getMessage()];
            LogHelper::saveErrorLog($id, $errordata); // Save error in table
            return $res = ['code' => 500, 'comment' => "Something went wrong. Please try again"];
          } catch (\Throwable $e) { // In case of fatal error
            $errordata = ['line' => $e->getLine(), 'error' => $e->getMessage()];
            LogHelper::saveErrorLog($id, $errordata); // Save error in table
            return $res = ['code' => 500, 'comment' => "Something went wrong. Please try again"];
          }
           
    }
}

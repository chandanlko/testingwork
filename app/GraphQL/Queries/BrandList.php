<?php

namespace App\GraphQL\Queries;
use Illuminate\Support\Facades\Log;
use App\Models\GetScore;
use App\Models\Brand;

class BrandList
{
    /**
     * @param  null  $_used for to get the brandlist Data on basis of parent id
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        $res=[];
        try{
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
           
            return  $result;
        } 
        catch (\Exception $e) {
            Log::info('Error in Graphql\Queries\BrandList ', ['line'=>$e->getLine(),'error'=>$e->getMessage()]);
           return $res=['comment'=>$e->getMessage(), 'code'=>202, 'details'=>$res];
        }
           
    }
}

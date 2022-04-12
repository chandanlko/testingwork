<?php

namespace App\GraphQL\Queries;
use App\Models\ParentModel;
use App\Models\GetScore;
use App\Models\CatHierarchy;
use Illuminate\Support\Facades\Log;


class SearchByArguement
{
    /** Resolver is used for searching the product by argument
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
    try
      { 
        $customer_id=$args['customer_id'];
	    $searchkeyword="%".$args['keyword']."%";
	    $type=$args['type'];
        switch ($type) {
            case 1:
                $res= $this->searchByCompany($customer_id,$searchkeyword);
                break;
            case 2;
                 $res= $this->searchByCategory($searchkeyword);
                 break;

            case 3;
                $res= $this->searchByKeyword($searchkeyword);
                break;
            
            default:
            $res=[];
            break;
        }
        if(empty($res['error'])){
            $data=$res;
            $comment="Data Fetched Successfully";
            $code=200;
        }
        else{
            $data=[];
            $comment=$res['error'];
            $code=202;
        }
        return ['type'=>$type,'details'=>array_slice($data,0,20),'comment'=>$comment,'code'=>$code];
        }
      catch(\Exception $e)
      {
          Log::info('Error in Graphql\Quries\SearchByArguement ', ['line' => $e->getLine(), 'error' => $e->getMessage()]);
          return ['type'=>$type,'details'=>[],'comment'=>$e->getMessage(),'code'=>202];
      }
       
    }

    public function searchByCompany(int $customer_id,string $searchkeyword) :array
    {
        $getCompanyData = ParentModel::select(
                            "parents.parent_id", 
                            "parents.parent_name",
                            "brands.brand_name", 
                            "brands.brand_id"
                        )->distinct('parents.parent_id')->where('parents.parent_name','ilike',$searchkeyword)->orWhere('brands.brand_name','ilike',$searchkeyword)
                        ->Join("brands", "parents.parent_id", "=", "brands.parent_id")
                        ->get();

        $res=[];
        if($getCompanyData->count()>0){
            foreach($getCompanyData as $key=>$valueData){
                $score=GetScore::scoringbyparent_id($customer_id,$valueData->parent_id);
                $res[]=[
                    'type'=>'parent',
                    'value'=>$valueData->parent_name,
                    'score'=>round($score,6),
                    'primary_id'=>$valueData->parent_id
                ];
                
             }

             foreach($getCompanyData as $key=>$valueData){
                $score=GetScore::scoringbyparent_id($customer_id,$valueData->parent_id);
                $res[]=[
                    'type'=>'Brand',
                    'value'=>$valueData->brand_name,
                    'score'=>round($score,6),
                    'primary_id'=>$valueData->brand_id
                ];
                
             }
            $collection = collect(array_filter($res));
            $sorted = $collection->sortBy(['score', 'parent_id', 'value']);
            $res=array_reverse($sorted->toArray());

        }else {
            $res=['error'=>"Not Found Any Data"];
        }
        return $res;
    }

    public function searchByCategory(string $searchkeyword){
        $categoryData=CatHierarchy::select('category_name', 'category_id')->distinct('category_name')->where('category_name','ilike',$searchkeyword)->get();
        $count=0;
        $res=[];
        if($categoryData->count()>0){
            foreach($categoryData as $categoryValue){
               $res[]=[
                        'countofproduct'=>$categoryValue->product->count(),
                        'type'=>'Category',
                        'value'=>$categoryValue->category_name,
                        'score'=>0,
                        'primary_id'=>$categoryValue->category_id
                     ];

            }
            $collection = collect($res);
            $sorted = $collection->sortBy(['countofproduct', 'value']);
            $res=array_reverse($sorted->toArray());
       
        }
        else {
             $res=['error'=>"Not Found Any Data"];
         }
        return $res;
            

    }

    public function searchByKeyword(string $searchkeyword){
        $categoryData=CatHierarchy::where('sub_category1','ilike',$searchkeyword)->orWhere('sub_category2','ilike',$searchkeyword)->get();
        $count=0;
        $res=[];
        if($categoryData->count()>0){
            foreach($categoryData as $categoryValue){
               $res[]=[
                        'countofproduct'=>$categoryValue->product->count(),
                        'type'=>'Category',
                        'value'=>$categoryValue->sub_category2,
                        'score'=>0,
                        'primary_id'=>$categoryValue->category_id
                     ];

            }
            $collection = collect($res);
            $sorted = $collection->sortBy(['countofproduct', 'value']);
            $res=array_reverse($sorted->toArray());
       
        }
        else {
             $res=['error'=>"Not Found Any Data"];
         }
          return $res;
            

    }
}

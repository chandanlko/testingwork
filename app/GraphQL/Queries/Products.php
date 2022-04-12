<?php

namespace App\GraphQL\Queries;

use App\Models\Product;
use App\Models\CatHierarchy;
use App\Models\Brand;
use App\Models\ParentModel;
use App\Models\CustomerValuePack;
use App\Models\ValuesPack;
use App\Models\GetScore;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;


class Products
{
    /** product search search key word and sku
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        try {
          if(!isset($args['pageSize']) || empty($args['pageSize'])){
            $args['pageSize']=10;
          }
          if(!isset($args['currentPage']) || empty($args['currentPage']) || $args['currentPage']<2){
            $args['currentPage']= 0;
          }
          else{
            $args['currentPage'] = ($args['currentPage']-1)*$args['pageSize'];
          }
          if(isset($args['search']) || !empty($args['search'])){

            $searchkeyword="%".$args['search']."%";
            $itemsdata = DB::table('products')->join('brands', 'brands.brand_id', '=', 'products.brand_id')
            ->join('parents', 'parents.parent_id', '=', 'brands.parent_id')
            ->join('cat_hierarchies','products.category_id','=','cat_hierarchies.category_id')
            ->select('products.*')
            ->where('parents.parent_name','like',$searchkeyword)
            ->orWhere('brands.brand_name','like',$searchkeyword)
            ->orWhere('cat_hierarchies.category_name','like',$searchkeyword)
            ->orWhere('cat_hierarchies.sub_category1','like',$searchkeyword)
            ->orWhere('cat_hierarchies.sub_category2','like',$searchkeyword);
           }
          else if(isset($args['sku']) || !empty($args['sku'])){
           $itemsdata= Product::where('upc_code', $args['sku']);
          }
          $count= $itemsdata->get()->count();
             $itemsdata=$itemsdata->offset($args['currentPage'])
                                    ->limit($args['pageSize'])
                                    ->get();
                                    
             $pricearray=['minimum_price'=>
                                            ['regular_price'=>
                                                            ['value'=>"100",
                                                            'currency'=>"USD"]
                                            ]
                        ];
         
             if(!empty($itemsdata)){
                 foreach($itemsdata as $key=>$values){
                    $categorydata=CatHierarchy::where('category_id',$values->category_id)->first();
                    $Brand=Brand::where('brand_id',$values->brand_id)->first();
                    $ParentModel=ParentModel::where('parent_id',$Brand->parent_id)->first();
                    $scoreArray=  GetScore::scoringbyparent_id($args['customer_id'],$Brand->parent_id);
                    $itemsdata[$key]->brand=$Brand;
                    if(is_numeric($scoreArray)){
                        $scoreArray=round($scoreArray,6);
                    }
                    else{
                        $scoreArray=0;
                    }
                    $itemsdata[$key]->parent=$ParentModel;
                    $itemsdata[$key]->score=$scoreArray;
                    $itemsdata[$key]->price_range=$pricearray;
                    $itemsdata[$key]->description=['html'=>''];
                    $itemsdata[$key]->image=['url'=>'', 'label'=>$categorydata->category_name];
                   
                    $categorylevel[0]=[
                                    'uid'=>isset($categorydata->category_id)?base64_encode($categorydata->category_id):"",
                                    'name'=>isset($categorydata->category_name)?$categorydata->category_name:"",
                                    'level'=>1,
                                    'id'=>$categorydata->category_id
                                    ];
                                    
                    $categorylevel[1]=[
                                    'uid'=>isset($categorydata->category_id)?base64_encode($categorydata->category_id):"",
                                    'name'=>isset($categorydata->sub_category1)?$categorydata->sub_category1:"",
                                    'level'=>2,
                                    'id'=>$categorydata->category_id,
                                    
                                    ];
                    $categorylevel[2]=[
                                    'uid'=>isset($categorydata->category_id)?base64_encode($categorydata->category_id):"",
                                    'name'=>isset($categorydata->sub_category2)?$categorydata->sub_category2:"",
                                    'level'=>3,
                                    'id'=>$categorydata->category_id
                                        ]; 
                  $itemsdata[$key]->categories=$categorylevel;
             }
             
             $responsearray=[
                            'total_count'=>$count,
                            'items'=>$itemsdata,
                            'page_info'=>['page_size'=>$args['pageSize'],'current_page'=>$args['currentPage']]
                         
                        ];
           
            return $responsearray;
          }
        }
         catch (\Exception $e) {
            Log::info('Error in Graphql\Queries\Products ', ['line'=>__LINE__,'error'=>$e->getMessage()]);
            return  __LINE__.$e->getMessage();
        }
           
       
    }
   
    
}

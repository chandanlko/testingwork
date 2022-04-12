<?php

namespace App\GraphQL\Queries;


use App\Models\Product;
use App\Models\CatHierarchy;
use App\Models\Brand;
use App\Models\ParentModel;
use App\Models\GetScore;
use App\Models\PreferenceList;

class GetRelatedParent
{
    /** Used to getting related products and brands
     * @param  null  $_ $args
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
      $customer_id=$args['customer_id'];
      $current_scoring=0;
      if(!empty($args['category_id'])){
        $where=['category_id'=>$args['category_id']];
      }
      else{
        $where=['upc_code'=>$args['sku']];
      }  
      $product=Product::where($where)->first();
      if(!empty($product)){
        $currentbrand=Brand::where('brand_id',$product->brand_id)->first();
        $current_scoring=GetScore::scoringbyparent_id($customer_id,$currentbrand->parent_id);
        $alldata=Product::where('category_id', $product->category_id)->get();
        $catgory_name=CatHierarchy::where('category_id',$product->category_id)->first();
           if(!empty($alldata)){
                foreach($alldata as $key=>$valuess_data){
                    $brand[]=Brand::where('brand_id',$valuess_data->brand_id)->first();
                   
                }
               if(!empty($brand) && count($brand)>1){
                    $uniquevalue=array_unique($brand);
                         foreach($uniquevalue as $keys_new=>$datavlue){
                           if($datavlue->brand_id != $product->brand_id){
                            $countproduct=Product::where('brand_id',$datavlue->brand_id)->get()->count();
                            $parentdata=ParentModel::where('parent_id',$datavlue->parent_id)->first();
                            $scoringbyparent_id=GetScore::scoringbyparent_id($customer_id,$datavlue->parent_id);
                             $checkexistance = PreferenceList::where(['customer_id' => $customer_id,'parent_id'=>$datavlue->parent_id])->first();
                             if(!empty($checkexistance)){
                                 if($checkexistance->type==1){
                                  $preferred=2;
                                 }else{
                                  $preferred=1;
                                 }
                             } else{
                               $preferred=0;
                             }
                                $brand_and_parent[]=[
                                    'brand_id'=>$datavlue->brand_id,
                                    'parent_id'=>$datavlue->parent_id,
                                    'parent_name'=>$parentdata->parent_name,
                                    'brand_name'=>$datavlue->brand_name,
                                    'score'=>round($scoringbyparent_id,6),
                                    'countproduct'=>$countproduct,
                                    'preferred'=>$preferred
                                    ];
                             
                             
                        }
                      }
                    usort($brand_and_parent, function($a, $b) {
                        if ($a['score'] == $b['score']) return 0;
                        return $b['score'] > $a['score'] ? 1 : -1;
                    });
                    $top_20_list=array_slice($brand_and_parent,0,20);
                    $collection = collect($top_20_list);
                    $sorted = $collection->sortBy(['score', 'parent_id', 'countproduct']);
                    $finaldata=array_reverse($sorted->toArray());
     
            return  [
                          'details'=>$finaldata,
                          'code'=>200,
                          'current_score'=>($current_scoring)?round($current_scoring,6):0,
                          'message'=>"Data Fetched Successfully!",
                          'error'=>0,
                          'subcategory1'=>$catgory_name->sub_category1,
                          'subcategory2'=>$catgory_name->sub_category2,
                          'category'=>$catgory_name->category_name,
                          'category_id'=>$catgory_name->category_id

                      ];
      }
      else {
          return [
                  'details'=>[],
                  'code'=>202,
                  'current_score'=>($current_scoring)?$current_scoring:0,
                  'message'=>"Sku Or category is invalid",
                  'error'=>1,
                  'subcategory1'=>$catgory_name->sub_category1,
                  'subcategory2'=>$catgory_name->sub_category2,
                          'category'=>$catgory_name->category_name,
                          'category_id'=>$catgory_name->category_id

                      ];
              }
          }
          else{
            return  [
                          'details'=>[],
                          'code'=>202,
                          'current_score'=>($current_scoring)?$current_scoring:0,
                          'message'=>"Brand is not available",
                          'error'=>1,
                          'subcategory1'=>$catgory_name->sub_category1,
                          'subcategory2'=>$catgory_name->sub_category2,
                          'category'=>$catgory_name->category_name,
                          'category_id'=>$catgory_name->category_id

                      ];
          }

      }
        else{
          return     [
            'details'=>[],
                            'code'=>202,
                            'current_score'=>($current_scoring)?$current_scoring:0,
                            'message'=>"Sku is not available",
                            'error'=>1,
                            'subcategory1'=>null,
                            'subcategory2'=>null,
                            'category'=>null,
                            'category_id'=>null

                        ];
            }  
    }

    
}  

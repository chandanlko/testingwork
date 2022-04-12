<?php

namespace App\GraphQL\Queries;
use Illuminate\Support\Facades\Log;
use App\Models\GetScore;

use App\Models\CatHierarchy;
use App\Models\Product;
use App\Models\Brand;
use App\Models\ParentModel;
class SearchTopProducts
{
    /** used for checking the top products and their parents, brands, category, subcategory based on keyword
     * @param  null  $args
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
      try
      {  
	      $customer_id=$args['customer_id'];

	      $searchkeyword="%".strtolower($args['keyword'])."%";
	      if(strlen(trim($args['keyword']))<=2) {
	      	return [];
	      	exit();
	      }
	      $type=$args['type'];
		  $categoryData=CatHierarchy::select('category_id')->where('sub_category1','ilike',$searchkeyword)
		  				->orWhere('sub_category2','like',$searchkeyword)
						->get();
		 $brand=Brand::select('brand_id')->where('brand_name','ilike',$searchkeyword)->get();
		 $parentData=ParentModel::select('parent_id')->where('parent_name','ilike',$searchkeyword)->get();
		 if($categoryData->count()>0){
			   foreach($categoryData as $valuess){
				$categoryids[]=$valuess->category_id;
			   }
			   $data=$this->CategorySearch($categoryids, $customer_id);
			   
			  
		  }
		  else if($brand->count()>0){
				foreach($brand as $key=>$BrandData){
					$brandsId[]=$BrandData->brand_id;
				}
				$data= $this->searchByBrands($brandsId,$customer_id);
		  }
		  else if($parentData->count()>0){
			 foreach($parentData as $keyss=>$parentDataValues){
				$parentIds[]=$parentDataValues->parent_id;
			 }
			 $data= $this->searchByParent($parentIds, $customer_id);
		  }
		  else{
			$data=[];
		  }
		  if(!empty($data)){
			  foreach($data as $key=>$values){
				  if($values['type']=='Parent'){
					$parentData2[]=$values;
				}
				  if($values['type']=='Brand'){
					$Brand[]=$values;
				}
				if($values['type']=='Keyword'){
					  $Keyword[]=$values;
				}
				 if($values['type']=='Category'){
				   $category[]=$values;
			    }
				 
			  }
			  $parentCollection = collect($parentData2);
              $dataParent = $parentCollection->sortBy(['score','upc_count']);
              $finaldata_for_best_matches=array_reverse($dataParent->toArray());

			  $BrandCollection = collect($Brand);
              $BrandData = $BrandCollection->sortBy(['score','upc_count']);
              $BrandData=array_reverse($BrandData->toArray());

			  $KeywordColection = collect($Keyword);
              $keywordData = $KeywordColection->sortBy('upc_count');
              $KeywordFinal=array_reverse($keywordData->toArray());

			  $CategoryCollecion= collect($category);
              $CategoryData = $CategoryCollecion->sortBy('upc_count');
              $categoryFinal=array_reverse($CategoryData->toArray());
			  
			  foreach($finaldata_for_best_matches as $keyss=>$ParentValues){
				  if($keyss<1) {
					$bestMatches[]=$ParentValues;	
				  }
				  else if($keyss>0 && $keyss <= 5) {
					$nonbest_matches[]=$ParentValues;
				  }
			  }
			  foreach($BrandData as $keyss2=>$BrandValue){
				if($keyss2<1) {
				  $bestMatches[]=$BrandValue;	
				}
				 else if($keyss2>0 && $keyss2 <= 10) {
					$nonbest_matches[]=$BrandValue;
				  }
			 	}
			 foreach($KeywordFinal as $keyss3=>$keywordValues){
				if($keyss3<1) {
				  $bestMatches[]=$keywordValues;	
				}
				 else if($keyss3>0 && $keyss3 <= 5) {
						$nonbest_matches[]=$keywordValues;
					}
				}


			 foreach($categoryFinal as $keyss4=>$categoryfinal){
				if($keyss4<1) {
				  $bestMatches[]=$categoryfinal;	
				}
			 }
			 
		  }
		 		
		  return ['best_matches'=>$bestMatches,'non_best_matches'=>$nonbest_matches];
		 
		}
		catch(\Exception $e)
		{
			Log::info('Error in Graphql\Quries\SearchTopProducts ', ['line' => $e->getLine(), 'error' => $e->getMessage()]);
			return [];
		}
    }
	public function getnumberofproducts($columname,$id){
		if($columname=='parent_id'){
			//get the brand
			$brand=Brand::where('parent_id',$id)->get();
			$count=0;
			foreach($brand as $keys=>$brandValues){
				$count += $this->getnumberofproducts('brand_id',$brandValues->brand_id);
			}
			return $count;
		}
		else{
			return Product::where($columname,$id)->get()->count();
		}
	}

	public function CategorySearch($id, $customer_id){
		try {
			$categorybasedsearch=CatHierarchy::select('category_id','sub_category2','category_name')->whereIn('category_id',$id)->get();
			$finaldata=[];
			if($categorybasedsearch->count()>0){
				foreach($categorybasedsearch as $key=>$valuess){
					  $categoriesID[]=$valuess->category_id;
					  $finaldata[]=[
						  'value'=>$valuess->sub_category2,
						  'type'=>'Keyword',
						  'upc_count'=>$this->getnumberofproducts('category_id',$valuess->category_id),
						  'score'=>0,
						  'primary_id'=>$valuess->category_id
					  ];
					 		
				}
			foreach($categorybasedsearch as $key=>$valuess){

					$finaldata[]=[
						'value'=>$valuess->category_name,
						'type'=>'Category',
						'upc_count'=>$this->getnumberofproducts('category_id',$valuess->category_id),
						'score'=>0,
						'primary_id'=>$valuess->category_id
					];			
			 }
				$products=Product::select('brand_id')->whereIn('category_id',$categoriesID)->get();
				 foreach($products as $key=>$productsValues){
				 	      $brandsId[]=$productsValues->brand_id;
				}	
				$brands=Brand::select('brand_id','brand_name','parent_id')->whereIn('brand_id',$brandsId)->get();
				foreach($brands as $brandsValue){
				   $score=GetScore::scoringbyparent_id($customer_id,$brandsValue->parent_id);
                   $parentIds[]=$brandsValue->parent_id;
				   $finaldata[]=[
					  'value'=>$brandsValue->brand_name,
					  'type'=>'Brand',
					  'upc_count'=>$this->getnumberofproducts('brand_id',$brandsValue->brand_id),
					  'score'=>round($score,6),
					  'primary_id'=>$brandsValue->brand_id
				  ];
				  
				}
				$parentdata=ParentModel::select('parent_id','parent_name')->whereIn('parent_id',$parentIds)->get();
				foreach($parentdata as $Parentvalue){
					 $score2=GetScore::scoringbyparent_id($customer_id,$Parentvalue->parent_id);
					  $finaldata[]=[
						  'value'=>$Parentvalue->parent_name,
						  'type'=>'Parent',
						  'upc_count'=>$this->getnumberofproducts('parent_id',$Parentvalue->parent_id),
						  'score'=>round($score2,6),
						  'primary_id'=>$Parentvalue->parent_id
					  ];
				}
				return $finaldata;
			}
			else{
				return false;
			}
		} catch(\Exception $e) {
			\Log::error($e->getMessage());
		}
	}
	public function searchByBrands($brandids,$customer_id){
		$products=Product::select('category_id')->whereIn('brand_id',$brandids)->get();
		foreach($products as $productsData){
			$ids[]=$productsData->category_id;
		}
		foreach(array_unique($ids) as $CategoryIds){
			$unqiueids[]=$CategoryIds;
		}
		return $this->CategorySearch($unqiueids,$customer_id);
	}
	public function searchByParent($parentIds, $customer_id){
		$brands=Brand::select('brand_id')->whereIn('parent_id',$parentIds)->get();
		if($brands->count()>0){
			foreach($brands as $brandsId){
				$ids[]=$brandsId->brand_id;
			}
			foreach(array_unique($ids) as $key=>$values){
				$brandsIds[]=$values;
			}
			return $this->searchByBrands($brandsIds, $customer_id);
		}
	}
}

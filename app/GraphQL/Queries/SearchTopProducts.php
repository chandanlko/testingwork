<?php

namespace App\GraphQL\Queries;

use Illuminate\Support\Facades\Log;
use App\Models\GetScore;

use App\Models\CatHierarchy;
use App\Models\Product;
use App\Models\Brand;
use App\Models\ParentModel;
use App\Models\PreferenceList;
use App\Helpers\LogHelper;

class SearchTopProducts
{
	/** used for checking the top products and their parents, brands, category, subcategory based on keyword
	 * @param  null  $args
	 * @param  array<string, mixed>  $args
	 */
	public function __invoke($_, array $args)
	{
		try {
			$response = [];
            $id = 0;
            $id = LogHelper::saveLogData($args['customer_id'], $args, $response, 'SearchByCompany');
			$customer_id = $args['customer_id'];
			$bestMatches = $nonbest_matches = $data = [];
			$searchkeyword = "%" . strtolower($args['keyword']) . "%";
			if (strlen(trim($args['keyword'])) <= 2) {
				return ['code'=>202,"comment"=>"Enter More than 2 Letters"];
			}
			
			$categoryData = CatHierarchy::where('sub_category1', 'ilike', $searchkeyword)
				->orWhere('sub_category2', 'like', $searchkeyword)
				->pluck('category_id')->toArray();
			
			if (count($categoryData) > 0) {
				$data = $this->CategorySearch($categoryData, $customer_id);
			} else {
				$brand = Brand::where('brand_name', 'ilike', $searchkeyword)->pluck('brand_id')->toArray();
				if (count($brand) > 0) {
					$data = $this->searchByBrands($brand, $customer_id);
				} else {
					$parentData = ParentModel::where('parent_name', 'ilike', $searchkeyword)->pluck('parent_id')->toArray();
					if (count($parentData) > 0) {
						$data = $this->searchByParent($parentData, $customer_id);
					}
				}
			}
			if (!empty($data)) {
				
				$parentCollection = collect($data['parentFinalData']);
				$dataParent = $parentCollection->sortBy(['score', 'upc_count']);
				$finaldata_for_best_matches = array_slice(array_reverse($dataParent->toArray()), 0, 6);
				
				foreach ($finaldata_for_best_matches as $key => $value) {
					$checkexistance = PreferenceList::where(['customer_id' => $customer_id, 'parent_id' => $value['primary_id']])->first();
					if (!empty($checkexistance)) {
						$preferred = ($checkexistance->type == 1) ? 2 : 1;
					} else {
						$preferred = 0;
					}
					$finaldata_for_best_matches[$key]['preferred'] = $preferred;
				}
				
				$BrandCollection = collect($data['brandFinalData']);
				$BrandData = $BrandCollection->sortBy(['score', 'upc_count']);
				$BrandData = array_slice(array_reverse($BrandData->toArray()), 0, 11);
				
				$KeywordColection = collect($data['keywordFinalData']);
				$keywordData = $KeywordColection->sortBy('upc_count');
				$KeywordFinal = array_slice(array_reverse($keywordData->toArray()), 0, 6);
				
				$CategoryCollecion = collect($data['categoryFinalData']);
				$CategoryData = $CategoryCollecion->sortBy('upc_count');
				$categoryFinal = array_slice(array_reverse($CategoryData->toArray()), 0, 1);
				
				
				foreach ($finaldata_for_best_matches as $keyss => $ParentValues) {
					if ($keyss == 0) {
						$bestMatches[] = $ParentValues;
					} else {
						$nonbest_matches[] = $ParentValues;
					}
				}
				foreach ($BrandData as $keyss2 => $BrandValue) {
					if ($keyss2 == 0) {
						$bestMatches[] = $BrandValue;
					} else {
						$nonbest_matches[] = $BrandValue;
					}
				}
				foreach ($KeywordFinal as $keyss3 => $keywordValues) {
					if ($keyss3 == 0) {
						$bestMatches[] = $keywordValues;
					} else {
						$nonbest_matches[] = $keywordValues;
					}
				}

				foreach ($categoryFinal as $keyss4 => $categoryfinal) {
					if ($keyss4 == 0) {
						$bestMatches[] = $categoryfinal;
					}
				}
			}
			 $response= ['code'=>200,'comment'=>'Data fetched Successfully','best_matches' => $bestMatches, 'non_best_matches' => $nonbest_matches];
			LogHelper::updateLogData($id, $args['customer_id'], $args, $response, 'SearchByCompany');
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

	public function CategorySearch($id, $customer_id)
	{
		try {
			$categorybasedsearch = CatHierarchy::select('category_id', 'sub_category2', 'category_name')->whereIn('category_id', $id)->get();
			$keywordFinalData = $parentFinalData = $categoryFinalData = $brandFinalData = [];
			if ($categorybasedsearch->count() > 0) {
				foreach ($categorybasedsearch as $valuess) {
					$categoriesID[] = $valuess->category_id;
					$upc_count = Product::select('product_id')->where('category_id', $valuess->category_id)->get()->count();
					$keywordFinalData[] = [
						'value' => $valuess->sub_category2,
						'type' => 'Keyword',
						'upc_count' => $upc_count,
						'score' => 0,
						'primary_id' => $valuess->category_id,
						'preferred' => null
					];

					$categoryFinalData[] = [
						'value' => $valuess->category_name,
						'type' => 'Category',
						'upc_count' => $upc_count,
						'score' => 0,
						'primary_id' => $valuess->category_id,
						'preferred' => null
					];
				}
				
				$brandsId = Product::whereIn('category_id', $categoriesID)->distinct()->pluck('brand_id')->toArray();
				
				$brands = Brand::select('brand_id', 'brand_name', 'parent_id')->whereIn('brand_id', $brandsId)->get();
				foreach ($brands as $brandsValue) {
					$score = GetScore::scoringbyparent_id($customer_id, $brandsValue->parent_id);
					$parentIds[] = $brandsValue->parent_id;
					$brandFinalData[] = [
						'value' => $brandsValue->brand_name,
						'type' => 'Brand',
						'upc_count' => Product::select('product_id')->where('brand_id', $brandsValue->brand_id)->get()->count(),
						'score' => round($score, 6),
						'primary_id' => $brandsValue->brand_id,
						'preferred' => null
					];
				}
				$parentdata = ParentModel::select('parent_id', 'parent_name')->distinct()->whereIn('parent_id', $parentIds)->get();
				
				foreach ($parentdata as $Parentvalue) {
					$score2 = GetScore::scoringbyparent_id($customer_id, $Parentvalue->parent_id);
					
					$parentFinalData[] = [
						'value' => $Parentvalue->parent_name,
						'type' => 'Parent',
						'upc_count' => Product::select('product_id')->join('brands', 'brands.brand_id', '=', 'products.brand_id')->join('parents', 'parents.parent_id', '=', 'brands.parent_id')->where('brands.parent_id', $Parentvalue->parent_id)->get()->count(),
						'score' => round($score2, 6),
						'primary_id' => $Parentvalue->parent_id,
						'preferred' => null
					];
				}
				
				$data = [
					'parentFinalData' => $parentFinalData,
					'brandFinalData' => $brandFinalData,
					'categoryFinalData' => $categoryFinalData,
					'keywordFinalData' => $keywordFinalData,
				];
				return $data;
			} else {
				return false;
			}
		} catch (\Exception $e) {
			Log::error($e->getMessage());
		}
	}
	public function searchByBrands($brandids, $customer_id)
	{
		$uniqueProducts = Product::whereIn('brand_id', $brandids)->distinct()->pluck('category_id')->toArray();
		return $this->CategorySearch($uniqueProducts, $customer_id);
	}
	public function searchByParent($parentIds, $customer_id)
	{
		$uniqueBrands = Brand::whereIn('parent_id', $parentIds)->pluck('brand_id')->toArray();
		if (count($uniqueBrands) > 0) {
			return $this->searchByBrands($uniqueBrands, $customer_id);
		}
	}
}

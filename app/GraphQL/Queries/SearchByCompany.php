<?php

namespace App\GraphQL\Queries;

use App\Models\ParentModel;
use App\Models\GetScore;
use App\Models\Brand;
use App\Models\Product;
use App\Helpers\LogHelper;


class SearchByCompany
{
    /** Resolver is used for searching the product by argument
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        try {
            $response = [];
            $id = 0;
            $id = LogHelper::saveLogData($args['customer_id'], $args, $response, 'SearchByCompany');
            $customer_id = $args['customer_id'];
            $searchkeyword = "%" . strtolower($args['keyword']) . "%";
            $type = $args['type'];
            $data_for_brands = Brand::select('brand_id', 'brand_name', 'parent_id')->where('brand_name', 'ilike', $searchkeyword)->with('parentModel')->get();
            
            if ($data_for_brands->count() > 0) {
                foreach ($data_for_brands as $valueParent) {
                    $score = GetScore::scoringbyparent_id($customer_id, $valueParent->parentModel->parent_id);
                    $parent_ids[] = $valueParent->parentModel->parent_id;
                    $res[] = [
                        'type' => 'Parent',
                        'value' => $valueParent->parentModel->parent_name,
                        'score' => round($score, 6),
                        'upc_count' => Product::select('product_id')->join('brands', 'brands.brand_id', '=', 'products.brand_id')->join('parents', 'parents.parent_id', '=', 'brands.parent_id')->where('brands.parent_id', $valueParent->parentModel->parent_id)->get()->count(),
                        'primary_id' => $valueParent->parentModel->parent_id,
                    ];
                }
                

                if (!empty($parent_ids)) {
                    $parent_ids = array_unique($parent_ids);
                    $brandata = Brand::select('brand_id', 'parent_id', 'brand_name')->whereIn('parent_id', $parent_ids)->get();
                    foreach ($brandata as $valueData) {
                        $score = GetScore::scoringbyparent_id($customer_id, $valueData->parent_id);
                        $res[] = [
                            'type' => 'Brand',
                            'value' => $valueData->brand_name,
                            'score' => round($score, 6),
                            'upc_count' => $valueData->product->count(),
                            'primary_id' => $valueData->brand_id,
                        ];
                    }
                } else {
                    $details = [];
                }
            } else {
                $data_for_company = ParentModel::select('parent_name', 'parent_id')->where('parent_name', 'ilike', $searchkeyword)->get();
                foreach ($data_for_company as $valueParent) {
                    $score = GetScore::scoringbyparent_id($customer_id, $valueParent->parent_id);
                    $parent_ids[] = $valueParent->parent_id;
                    $res[] = [
                        'type' => 'Parent',
                        'value' => $valueParent->parent_name,
                        'score' => round($score, 6),
                        'upc_count' => Product::select('product_id')->join('brands', 'brands.brand_id', '=', 'products.brand_id')->join('parents', 'parents.parent_id', '=', 'brands.parent_id')->where('brands.parent_id', $valueParent->parent_id)->get()->count(),
                        'primary_id' => $valueParent->parent_id,
                    ];
                }
                if (!empty($parent_ids)) {
                    $brandata = Brand::select('brand_id', 'parent_id', 'brand_name')->whereIn('parent_id', $parent_ids)->get();
                    foreach ($brandata as $valueData) {
                        $score = GetScore::scoringbyparent_id($customer_id, $valueData->parent_id);
                        $res[] = [
                            'type' => 'Brand',
                            'value' => $valueData->brand_name,
                            'score' => round($score, 6),
                            'upc_count' => $valueData->product->count(),
                            'primary_id' => $valueData->brand_id,
                        ];
                    }
                }
            }
            $company = [];
            $brands = [];
            $best_matches = [];
            $non_best_matches = [];
            if (!empty($res)) {
                foreach ($res as $valuess) {
                    if ($valuess['type'] == 'Parent') {
                        $company[] = $valuess;
                    }
                    if ($valuess['type'] == 'Brand') {
                        $brands[] = $valuess;
                    }
                }
                $collection_for_company = collect($company);
                $collection_for_company = $collection_for_company->unique('primary_id');
                $sorted_for_company = $collection_for_company->sortBy(['score', 'upc_count']);
                $res_for_company = array_reverse($sorted_for_company->toArray());
                $res_for_company = array_slice($res_for_company, 0, 6);

                $collection_for_brands = collect($brands);
                $collection_for_brands = $collection_for_brands->unique('primary_id');
                $sorted_for_brands = $collection_for_brands->sortBy(['score', 'upc_count']);
                $res_for_brands = array_reverse($sorted_for_brands->toArray());
                $res_for_brands = array_slice($res_for_brands, 0, 16);


                foreach ($res_for_company as $indexing => $valuess) {
                    if ($indexing == 0) {
                        $best_matches[] = $valuess;
                    } else {
                        $non_best_matches[] = $valuess;
                    }
                }
                foreach ($res_for_brands as $indexing2 => $avluess) {
                    if ($indexing2 == 0) {
                        $best_matches[] = $avluess;
                    } else {
                        $non_best_matches[] = $avluess;
                    }
                }
                
                if (!empty($best_matches)) {
                    $details = ['best_matches' => $best_matches, 'non_best_matches' => $non_best_matches];
                    $finalres = [
                        'code' => 200,
                        'details' => $details,
                        'comment' => 'Data Fetched Successfully',
                        'type' => $type
                    ];
                } else {
                    $finalres = [
                        'code' => 202,
                        'details' => [],
                        'comment' => 'Data Not Found',
                        'type' => $type
                    ];
                }
            } else {
                $finalres = [
                    'code' => 202,
                    'details' => [],
                    'comment' => 'Data Not Found',
                    'type' => $type
                ];
            }
            LogHelper::updateLogData($id, $args['customer_id'], $args, $finalres, 'SearchByCompany');
            return $finalres;
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

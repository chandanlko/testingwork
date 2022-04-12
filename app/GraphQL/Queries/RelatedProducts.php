<?php
namespace App\GraphQL\Queries;

use App\Models\Product;
use App\Models\CatHierarchy;
use App\Models\Brand;
use App\Models\ParentModel;
use App\Models\CustomerValuePack;
use App\Models\ValuesPack;
use App\Models\ValuePackScore;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use App\Models\GetScore;

class RelatedProducts
{
    /** product search category name, parent name, brandname 
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    protected $argument;
    public function __invoke($_, array $args)
    {

        try
        {
            if (!isset($args['pageSize']) || empty($args['pageSize']))
            {
                $args['pageSize'] = 10;
            }
            if (!isset($args['currentPage']) || empty($args['currentPage']) || $args['currentPage'] < 2)
            {
                $args['currentPage'] = 0;
            }
            else
            {
                $args['currentPage'] = ($args['currentPage'] - 1) * $args['pageSize'];
            }
            if (isset($args['brand']) || !empty($args['brand']))
            {
                $where['brands.brand_name'] = $args['brand'];
            }
            if (isset($args['category']) || !empty($args['category']))
            {
                $where['products.category_id'] = base64_decode($args['category']);
            }
            if (isset($args['parent']) || !empty($args['parent']))
            {
                $where['parents.parent_name'] = $args['parent'];

            }
            $itemsdata = DB::table('products')->join('brands', 'brands.brand_id', '=', 'products.brand_id')
                ->join('parents', 'parents.parent_id', '=', 'brands.parent_id')
                ->select('products.*')
                ->where($where);
            $count = $itemsdata->get()
                ->count();
            $itemsdata = $itemsdata->offset($args['currentPage'])->limit($args['pageSize'])->get()
                ->toArray();
            $pricearray = ['minimum_price' => ['regular_price' => ['value' => "100", 'currency' => "USD"]]];

            if (!empty($itemsdata))
            {
                foreach ($itemsdata as $key => $values)
                {
                    $categorydata = CatHierarchy::where('category_id', $values->category_id)
                        ->first();
                    $Brand = Brand::where('brand_id', $values->brand_id)
                        ->first();
                    $ParentModel = ParentModel::where('parent_id', $Brand->parent_id)
                        ->first();
                    $scoreArray= GetScore::scoringbyparent_id($args['customer_id'],$Brand->parent_id);
                   // $scoreArray = $scoreArray=$this->getvaluepack($args['customer_id'],$values->upc_code);
                    if(is_numeric($scoreArray)){
                        $scoreArray=round($scoreArray);
                    }
                    else{
                        $scoreArray=0;
                    }
                    $itemsdata[$key]->brand = $Brand;
                    $itemsdata[$key]->parent = $ParentModel;
                    $itemsdata[$key]->score = $scoreArray;
                    $itemsdata[$key]->price_range = $pricearray;
                    $itemsdata[$key]->description = ['html' => ''];
                    $itemsdata[$key]->image = ['url' => '', 'label' => $categorydata->category_name];
                    $categorylevel[0] = ['uid' => isset($categorydata->category_id) ? base64_encode($categorydata->category_id) : "", 'name' => isset($categorydata->category_name) ? $categorydata->category_name : "", 'level' => 1, 'id' => $categorydata->category_id];
                    $categorylevel[1] = ['uid' => isset($categorydata->category_id) ? base64_encode($categorydata->category_id) : "", 'name' => isset($categorydata->sub_category1) ? $categorydata->sub_category1 : "", 'level' => 2, 'id' => $categorydata->category_id];
                    $categorylevel[2] = ['uid' => isset($categorydata->category_id) ? base64_encode($categorydata->category_id) : "", 'name' => isset($categorydata->sub_category2) ? $categorydata->sub_category2 : "", 'level' => 3, 'id' => $categorydata->category_id];
                    $itemsdata[$key]->categories = $categorylevel;

                }
            }
            return $responsearray = ['total_count' => $count, 'items' => $itemsdata, 'page_info' => ['page_size' => $args['pageSize'], 'current_page' => $args['currentPage']]

            ];

            return $responsearray;
        }
        catch(\Exception $e)
        {
            Log::info('Error in Graphql\Queries\RelatedProducts ', ['line' => __LINE__, 'error' => $e->getMessage() ]);
            return __LINE__ . $e->getMessage();
        }

    }
   
}


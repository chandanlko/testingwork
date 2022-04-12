<?php
namespace App\GraphQL\Queries;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PreferencesValidate
{
    /** check the preference validation for exist recods.
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        try
        {
            $preference = DB::table('preference_lists')->join('brands', 'brands.brand_id', '=', 'preference_lists.brand_id')
                ->join('parents', 'parents.parent_id', '=', 'preference_lists.parent_id')
                ->where(['preference_lists.customer_id' => $args['customer_id'], 'parents.parent_name' => $args['parent']])->first();

            if (!empty($preference))
            {
                $response['Records'] = ['code' => 202, 'comment' => 'Record already exist in preferred list', 'type' => $preference->type];
            }
            else
            {
                $response['Records'] = ['code' => 200, 'comment' => 'Record not exist in preferred list', 'type' => 0];
            }
            return $response;

        }
        catch(\Exception $e)
        {
            Log::info('Error in Graphql\Queries\PreferencesValidate ', ['line' => __LINE__, 'error' => $e->getMessage() ]);
            return __LINE__ . $e->getMessage();
        }

    }

}


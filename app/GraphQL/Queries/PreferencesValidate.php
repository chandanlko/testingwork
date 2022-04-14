<?php
namespace App\GraphQL\Queries;

use Illuminate\Support\Facades\DB;
use App\Helpers\LogHelper;

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
            $response = [];
            $id = 0;
            $id = LogHelper::saveLogData($args['customer_id'], $args, $response, 'PreferencesValidate');
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
            LogHelper::updateLogData($id, $args['customer_id'], $args, $response, 'RegisterUpc');
            return $response;

        } catch (\Exception $e) { // In case of exception
            $errordata = ['line' => $e->getLine(), 'error' => $e->getMessage()];
            LogHelper::saveErrorLog($id, $errordata); // Save error in table
            return $response['Records'] = ['code' => 500, 'comment' => "Something went wrong. Please try again"];
          } catch (\Throwable $e) { // In case of fatal error
            $errordata = ['line' => $e->getLine(), 'error' => $e->getMessage()];
            LogHelper::saveErrorLog($id, $errordata); // Save error in table
            return $response['Records'] = ['code' => 500, 'comment' => "Something went wrong. Please try again"];
          }

    }

}


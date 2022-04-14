<?php

namespace App\GraphQL\Queries;

use App\Models\ValuesPack;
use Exception;
use Illuminate\Support\Facades\Log;
use App\Helpers\LogHelper;

class ValuesPackData
{
    /** Used for static Values API
     * @param  null   $args
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        try {
            $response = [];
            $id = 0;
            $id = LogHelper::saveLogData('', $args, $response, 'SearchByCompany');
            $getdata = ValuesPack::get();
            if (!empty($getdata)) {
                foreach ($getdata as $keys => $valuespack) {
                    $getdata[$keys]['name'] = $valuespack->values_pack_name;
                }
            }
            $response['code'] = 200;
            $response['comment'] = "Data Fetched Successfully";
            $response['name'] = $getdata;
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
}

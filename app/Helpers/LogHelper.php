<?php

namespace App\Helpers;
use App\Models\LogData;

class LogHelper
{
    static public function saveLogData($customerid='',$request='',$response='',$api=''){
        $data=[
            'customer_id'=>$customerid,
            'request_values'=>json_encode($request),
            'response_values'=>json_encode($response),
            'api_file'=>$api
        ];
        LogData::create($data);
    }
}

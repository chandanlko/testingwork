<?php

namespace App\Helpers;
use App\Models\LogData;
use App\Models\ErrorLog;

class LogHelper
{
    static public function saveLogData($customerid='',$request='',$response='',$api=''){
        $data=[
            'customer_id'=>$customerid,
            'request_values'=>json_encode($request),
            'response_values'=>json_encode($response),
            'api_file'=>$api
        ];
        return LogData::create($data)->id;
    }
    static public function updateLogData($id,$customerid='',$request='',$response='',$api=''){
        $data=[
            'customer_id'=>$customerid,
            'request_values'=>json_encode($request),
            'response_values'=>json_encode($response),
            'api_file'=>$api
        ];
        return LogData::where('id',$id)->update($data);
    }
    static public function saveErrorLog($id = 0, $dataerror=''){
        $data=[
            'log_id'=>$id,
            'error'=> json_encode($dataerror)
        ];
        return ErrorLog::create($data)->id;
    }
}

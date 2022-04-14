<?php

namespace App\GraphQL\Mutations;
use App\Models\CustomerActivity;
use App\Helpers\LogHelper;
class CreateCustomerSearch
{
    /** used for creation customer activity and set the response.
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        
       try 
       {
        $response=[];
        $id=0;
        $id= LogHelper::saveLogData('',$args,$response,'CreateCustomerSearch');
            $data=[
                    'term'=>isset($args['term'])?$args['term']:"",
                    'os'=>isset($args['os'])?$args['os']:"",
                    'ip_address'=>isset($args['ip_address'])?$args['ip_address']:"",
                    'type'=>isset($args['type'])?$args['type']:"",
                    'customer_id'=>$args['customer_id']
            ];
            CustomerActivity::create($data);
            $response=['search_term'=>$data,'code'=>200, 'comment'=>"Activity saved"];
            LogHelper::updateLogData($id,$args['customer_id'],$args,$response,'CreateCustomerSearch');
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

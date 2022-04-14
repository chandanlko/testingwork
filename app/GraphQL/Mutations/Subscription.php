<?php

namespace App\GraphQL\Mutations;

use App\Models\Customer;
use App\Helpers\LogHelper;

class Subscription
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        
         try{
            $response=[];
            $id=0;
            $id= LogHelper::saveLogData($args['customer_id'],$args,$response,'RegisterUpc');
            $checkcustomer=Customer::where('id',$args['customer_id'])->first();
            if(!empty($checkcustomer)){
                Customer::where('id',$args['customer_id'])->update(['is_subscribed'=>$args['is_subscribed']]);
                $response=['code'=>200, 'comment'=>"Subscription Updated","customer_id"=>$args['customer_id'],'is_subscribed'=>$args['is_subscribed']];
            }
            else{
                $response=['code'=>201, 'comment'=>"Invalid customer id"];
            }
            LogHelper::updateLogData($id,$args['customer_id'],$args,$response,'Subscritpion');
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

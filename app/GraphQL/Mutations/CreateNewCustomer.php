<?php

namespace App\GraphQL\Mutations;
use App\Models\Customer;
use Illuminate\Support\Facades\Log;
use App\Helpers\LogHelper;

class CreateNewCustomer
{
    /** 
     * @param  null  $args
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args) {
       
        try {
            $response=[];
            $id=0;
            $id= LogHelper::saveLogData('',$args,$response,'CreateNewCustomer');
            $customerrecord=Customer:: where(['phone_number'=> $args['phoneNumber']])->first();
            if(!empty($customerrecord)) {
                $checkemaill=Customer::where('email',$args['email'])->where('id','!=',$customerrecord->id)->get()->count();
                if($checkemaill < 1) {
                    $data=[
                            'firstname'=>isset($args['firstname'])?$args['firstname']:'',
                            'lastname'=>isset($args['lastname'])?$args['lastname']:'',
                            'email'=>isset($args['email'])?$args['email']:'',
                            'password'=>isset($args['password'])?$args['password']:'',
                            'date_of_birth'=>isset($args['date_of_birth'])?$args['date_of_birth']:null,
                            'gender'=>isset($args['gender'])?$args['gender']:'',
                            'zip_code'=>isset($args['zip_code'])?$args['zip_code']:'',
                            'is_subscribed'=>isset($args['is_subscribed'])?$args['is_subscribed']:0,
                            'device_id'=>isset($args['deviceId'])?$args['deviceId']:'',
                            'phone_number'=>isset($args['phoneNumber'])?$args['phoneNumber']:''    
                    ];
                    Customer::where('id', $customerrecord->id)->update($data);
                    $response['customer']['response']=['code'=>200,'message'=>'Customer Updated Successfully', 'customer_id'=>$customerrecord['id']];
                } else {
                    $response['customer']['response']=['code'=>202,'message'=>'Email is already exists','customer_id'=>$customerrecord['id']];  
                }
            }else{ 
                $response['customer']['response']=['code'=>202,'message'=>'Mobile Number or device id does not match to database','customer_id'=>null];
            }
            LogHelper::updateLogData($id,'',$args,$response,'CreateNewCustomer');
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

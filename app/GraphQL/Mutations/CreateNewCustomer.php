<?php

namespace App\GraphQL\Mutations;
use App\Models\Customer;

class CreateNewCustomer
{
    /** 
     * @param  null  $args
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        try
        {
                //check the entry for existed customer
                 $customerrecord=Customer:: where(['phone_number'=>$args['phoneNumber'],'device_id'=>$args['deviceId']])->first();
                if(!empty($customerrecord)){
                $checkemaill=Customer::where('email',$args['email'])->get()->count();
                if($checkemaill < 1){
                $data=[
                        'firstname'=>isset($args['firstname'])?$args['firstname']:'',
                        'lastname'=>isset($args['lastname'])?$args['lastname']:'',
                        'email'=>isset($args['email'])?$args['email']:'',
                        'password'=>isset($args['password'])?$args['password']:'',
                        'date_of_birth'=>isset($args['date_of_birth'])?$args['date_of_birth']:'',
                        'gender'=>isset($args['gender'])?$args['gender']:'',
                        'zip_code'=>isset($args['zip_code'])?$args['zip_code']:'',
                        'is_subscribed'=>isset($args['is_subscribed'])?$args['is_subscribed']:'',
                        'device_id'=>isset($args['deviceId'])?$args['deviceId']:'',
                        'phone_number'=>isset($args['phoneNumber'])?$args['phoneNumber']:''    
                ];
                Customer::where('id',$customerrecord['id'])->update($data);
                $response['customer']['response']=['code'=>200,'message'=>'Customer Updated Successfully', 'customer_id'=>$customerrecord['id']];
             }else {
                $response['customer']['response']=['code'=>202,'message'=>'Email is already exists','customer_id'=>$customerrecord['id']];
             }
            }  
            else{ 
                $response['customer']['response']=['code'=>202,'message'=>'Mobile Number device does not match to database','customer_id'=>null];
                }
               
            return $response;
        }
        catch(\Exception $e)
        {
            Log::info('Error in Graphql\Mutation\CreateNewCustomer ', ['line' => __LINE__, 'error' => $e->getMessage() ]);
            return __LINE__ . $e->getMessage();
        } 
    }
}

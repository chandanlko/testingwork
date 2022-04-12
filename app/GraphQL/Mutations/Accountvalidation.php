<?php

namespace App\GraphQL\Mutations;
use App\Models\Otp;
use App\Models\Customer;
use Illuminate\Support\Facades\Log;
use JWTAuth;





class AccountValidation
{
    /** Resolver is used for validating the otp
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        try
        {
            
        
            $user = Otp::where(['mobile_number'=>$args['mobile_number'],'device_id'=>$args['device_id'],'account_code'=>$args['accountCode']])->first();
            if(!empty($user)){
                $token = JWTAuth::fromUser($user);
                $customer = Customer::where('phone_number',$args['mobile_number'])->first();
                $response =[
                    'accountCode'=>$args['accountCode'],
                    'mobile_number'=>$args['mobile_number'],
                    'device_id'=>$args['device_id'],
                    'iscodeValidated'=>1,
                    'comment'=>"Account code is valid",
                    'code'=>200,
                    'access_token'=>$token,
                    'customer_id'=>$customer->id,
                    'user_new'=>0
                   ];
            }
           else 
                $response =[
                    'accountCode'=>$args['accountCode'],
                    'mobile_number'=>$args['mobile_number'],
                    'device_id'=>$args['device_id'],
                    'iscodeValidated'=>0,
                    'comment'=>"Invalid Match",
                    'code'=>202,
                    'access_token'=>Null,
                    'customer_id'=>null,
                    'user_new'=>0
                   ];
           
            return $response;
        } 
            catch(\Exception $e)
            {
                Log::info('Error in Graphql\Mutation\Accountvalidation ', ['line' => __LINE__, 'error' => $e->getMessage() ]);
                return __LINE__ . $e->getMessage();
            } 
       
    }
}

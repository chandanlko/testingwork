<?php

namespace App\GraphQL\Mutations;

use App\Models\Otp;
use App\Models\Customer;
use App\Models\CustomerValuePack;
use App\Models\PreferenceList;
use JWTAuth;
use App\Helpers\LogHelper;





class AccountValidation
{
    /** Resolver is used for validating the otp
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        try {
            $response = [];
            $id = 0;
            $id = LogHelper::saveLogData(null, $args, $response, 'AccountValidation');
            $user = Otp::where(['mobile_number' => $args['mobile_number'], 'device_id' => $args['device_id'], 'account_code' => $args['accountCode']])->first();
            if (!empty($user)) {
                $user->status =1;
                $user->save();
               // Otp::where('id', $user->id)->update(['status' => 1]);
                $token = JWTAuth::fromUser($user);
                $customer = Customer::where('phone_number', $args['mobile_number'])->first();
                if ($customer) {
                    Customer::where('id', $customer->id)->update(['device_id' => $args['device_id']]);
                    $customerid = $customer->id;
                    $is_subscribed = ($customer->is_subscribed === NULL) ? false : true;
                    $customerProfile = $customer->email ? true : false;
                    $old_user=true;
                } else {
                    $customerid = Customer::create(['phone_number' => $args['mobile_number'],'device_id'=> $args['device_id'] ])->id;
                    $is_subscribed = false;
                    $customerProfile = false;
                    $old_user=false;
                }
                $CustomerValuePack = CustomerValuePack::where('customer_id', $customerid)->get()->count();
                if ($CustomerValuePack > 0) {
                    $CustomerValuePack = true;
                } else {
                    $CustomerValuePack = false;
                }
                $PreferenceList = PreferenceList::where('customer_id', $customerid)->get();
                if ($PreferenceList->count() > 0) {
                    $PreferenceList = true;
                } else {
                    $PreferenceList = false;
                }
                $response = [
                    'accountCode' => $args['accountCode'],
                    'mobile_number' => $args['mobile_number'],
                    'device_id' => $args['device_id'],
                    'iscodeValidated' => 1,
                    'comment' => "Account code is valid",
                    'code' => 200,
                    'access_token' => $token,
                    'customer_id' => $customerid,
                    'user_new' => 0,
                    'preference' => $PreferenceList,
                    'valuePack' => $CustomerValuePack,
                    'is_subscribed' => $is_subscribed,
                    'customerProfile' => $customerProfile,
                    'old_user'=>$old_user
                ];
            } else
                $response = [
                    'accountCode' => $args['accountCode'],
                    'mobile_number' => $args['mobile_number'],
                    'device_id' => $args['device_id'],
                    'iscodeValidated' => 0,
                    'comment' => "Invalid Match",
                    'code' => 202,
                    'access_token' => null,
                    'customer_id' => null,
                    'user_new' => 1,
                    'preference' => false,
                    'valuePack' => false,
                    'is_subscribed' => false,
                    'customerProfile' => false,
                    'old_user'=>$old_user
                ];
            LogHelper::updateLogData($id, '', $args, $response, 'AccountValidation');
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

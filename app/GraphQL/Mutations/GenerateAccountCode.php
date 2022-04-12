<?php

namespace App\GraphQL\Mutations;
use App\Models\Otp;
use App\Models\Customer;

class GenerateAccountCode
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
       $rdmstring= $randomcode=substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,3);
       $checkdata= Customer::where(['phone_number'=>$args['mobile_number']])->get();
       $data=['device_id'=>$args['device_id'],'mobile_number'=>$args['mobile_number'],'account_code'=>$rdmstring,'status'=>0];

       if($checkdata->count()>0){
        $getid=$checkdata[0]['id'];
        $olddata=1;
       	$checkdevice_id=Otp::where(['mobile_number'=>$args['mobile_number'],'device_id'=>$args['device_id']])->get();
       	if($checkdevice_id->count()>0){
            $otp['account_code']=$rdmstring;
       		  Otp::where('id',$checkdevice_id[0]->id)->update($otp);
       	}
       	else{
       		   Otp::create($data);	
       	}
       }
       else{
           Otp::create($data);
           $customerdata=[
            'device_id'=>isset($args['device_id'])?$args['device_id']:'',
            'phone_number'=>isset($args['mobile_number'])?$args['mobile_number']:''    
    		  ];
           $customer=Customer::create($customerdata);
           $getid=$customer->id;
           $olddata=0;
       }
       $response['customer']=['old_user'=>$olddata,'customer_id'=>$getid,'device_id'=>$args['device_id'],'mobile_number'=>$args['mobile_number'],'account_code'=>$rdmstring,'code'=>200,'error'=>0,'comment'=>"Account code successfully generated"];
       return $response;
    }
}

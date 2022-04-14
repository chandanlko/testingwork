<?php

namespace App\GraphQL\Mutations;
use App\Models\Otp;
use App\Helpers\LogHelper;

class GenerateAccountCode
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
    
      try{
        $response = [];
        $id = 0;
        $id = LogHelper::saveLogData('', $args, $response, 'GenerateAccountCode');
        $rdmstring= substr(str_shuffle('ABCDEFGHIJKLMNOPQRSTUVWXYZ'),1,3);
        $data= ['device_id'=> $args['device_id'], 'mobile_number'=> $args['mobile_number'], 'account_code'=>$rdmstring, 'status'=>0];
          $checkdevice_id = Otp::where(['mobile_number'=>$args['mobile_number'], 'device_id'=>$args['device_id']])->get();
          if($checkdevice_id->count()>0){
              $otp['account_code']=$rdmstring;
              Otp::where('id',$checkdevice_id[0]->id)->update($otp);
          }
       	else{
       		   Otp::create($data);	
       	}
       $response['customer']=['device_id'=>$args['device_id'],'mobile_number'=>$args['mobile_number'],'account_code'=>$rdmstring,'code'=>200,'error'=>0,'comment'=>"Account code successfully generated"];
       LogHelper::updateLogData($id, '', $args, $response, 'GenerateAccountCode');
       return $response;
      } catch (\Exception $e) { // In case of exception
        $errordata = ['line' => $e->getLine(), 'error' => $e->getMessage()];
        LogHelper::saveErrorLog($id, $errordata); // Save error in table
        return $response['customer'] = ['code' => 500, 'comment' => "Something went wrong. Please try again"];
      } catch (\Throwable $e) { // In case of fatal error
        $errordata = ['line' => $e->getLine(), 'error' => $e->getMessage()];
        LogHelper::saveErrorLog($id, $errordata); // Save error in table
        return $response['customer'] = ['code' => 500, 'comment' => "Something went wrong. Please try again"];
      }
    }
}

<?php

namespace App\GraphQL\Queries;
use JWTAuth;
use App\Models\Otp;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Log;
use App\Helpers\LogHelper;

class RefreshToken
{
    /** for generate New token.
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        
        try
        {
            $response=[];
            $id=0;
            $id= LogHelper::saveLogData('',$args,$response,'RefreshToken');
            $token=null;
            $user = Otp::where('id','>',0)->first();
            if(!empty($user)){
                $token = JWTAuth::fromUser($user);
            }
            $response=['code'=>200,'comment'=>'token Generated','token'=>$token];
            LogHelper::updateLogData($id,$args['customer_id'],$args,$response,'RefreshToken');
            return $response;
                
        }
            catch(\Exception $e)
            {
            $errordata= ['line' => $e->getLine(), 'error' => $e->getMessage()];
            Log::info('Error in Graphql\Quries\RefreshToken ',$errordata);
            LogHelper::saveErrorLog($id,$errordata);
            return $response=['code'=>500, 'comment'=>"Something went wrong. Please try again",'token'=>null];
            }
    }
}

<?php

namespace App\GraphQL\Queries;
use JWTAuth;
use App\Models\Otp;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Log;
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
            $token=null;
            $user = Otp::where('id','>',0)->first();
            if(!empty($user)){
                $token = JWTAuth::fromUser($user);
            }
            return ['token'=>$token];
                
        }
     
            catch(\Exception $e)
            {
                Log::info('Error in App\GraphQL\Queries\RefreshToken ', ['line' => __LINE__, 'error' => $e->getMessage() ]);
                return __LINE__ . $e->getMessage();
            }
    }
}

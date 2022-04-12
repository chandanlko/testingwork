<?php

namespace App\GraphQL\Mutations;
use Illuminate\Support\Facades\Log;
use App\Models\CustomerActivity;

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
            $data=[
                    'term'=>isset($args['term'])?$args['term']:"",
                    'os'=>isset($args['os'])?$args['os']:"",
                    'ip_address'=>isset($args['ip_address'])?$args['ip_address']:"",
                    'type'=>isset($args['type'])?$args['type']:"",
                    'customer_id'=>$args['customer_id']
            ];
            CustomerActivity::create($data);
            $response=['search_term'=>$data];
            return $response;

       }
        catch(\Exception $e)
        {
            Log::info('Error in Graphql\Mutation\class CreateCustomerSearch
            ', ['line' => __LINE__,  'error' => $e->getMessage()]);
            return __LINE__ . $e->getMessage();
        } 
    }
}

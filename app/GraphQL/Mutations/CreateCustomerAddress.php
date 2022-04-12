<?php

namespace App\GraphQL\Mutations;
use Illuminate\Support\Facades\Log;
use App\Models\Region;
use App\Models\CustomerAddress;

class CreateCustomerAddress
{
    /** this mutation file used to create address with customer_id
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        try
        {
            $region=isset($args['region']['region'])?$args['region']['region']:"";
            $code=isset($args['region']['region_code'])?$args['region']['region_code']:"";
            $regiondata=['region_code'=>$code,'region'=>$region];
            Region::create($regiondata);
            $detailedaddress=[
                                'country_code'=>isset($args['country_code'])?$args['country_code']:"",
                                'street'=>isset($args['street'])?$args['street']:"",
                                'telephone'=>isset($args['telephone'])?$args['telephone']:"",
                                'postcode'=>isset($args['postcode'])?$args['postcode']:"",
                                'city'=>isset($args['city'])?$args['city']:"",
                                'firstname'=>isset($args['firstname'])?$args['firstname']:"",
                                'lastname'=>isset($args['lastname'])?$args['lastname']:"",
                                'customer_id'=> isset($args['customer_id'])?$args['customer_id']:0,
                                'default_shipping'=>isset($args['default_shipping'])?$args['default_shipping']:"",
                                'default_billing'=>isset($args['default_billing'])?$args['default_billing']:""
                                

                            ];
            
            CustomerAddress::create($detailedaddress);
            return array_merge(['region'=>$regiondata],$detailedaddress);
        }
        catch(\Exception $e)
        {
            Log::info('Error in Graphql\Mutation\CreateCustomerAddress ', ['line' => __LINE__, 'error' => $e->getMessage() ]);
            return __LINE__ . $e->getMessage();
        } 
    }
}

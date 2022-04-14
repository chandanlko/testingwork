<?php

namespace App\GraphQL\Mutations;
use App\Models\Region;
use App\Models\CustomerAddress;
use App\Helpers\LogHelper;
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
            $response = [];
            $id = 0;
            $id = LogHelper::saveLogData($args['customer_id'], $args, $response, 'AccountValidation');
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
            $response=array_merge(['code'=>200,'comment'=>"Data saved"],['region'=>$regiondata],$detailedaddress);
            LogHelper::updateLogData($id, $args['customer_id'], $args, $response, 'AccountValidation');
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

<?php

namespace App\GraphQL\Mutations;
use App\Models\upcRegister;
use App\Helpers\LogHelper;

class RegisterUpc
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
       //return $args['customer_id'];
       if(empty($args['customer_id']) || empty($args['upc'])){
           $response=['code'=>202, 'comment'=>"customer_id or upc is empty"];
       }
       else{
           $checkUpc=upcRegister::where('customer_id',$args['customer_id'])->where('upc',$args['upc'])->get();
           if($checkUpc->count()>0){
            upcRegister::where('id',$checkUpc[0]->id)->update($args);
            $response=['code'=>200, 'comment'=>"Upc is updated."];
           }
           else{
            upcRegister::create($args);
            $response=['code'=>200, 'comment'=>"Upc is stored."];
           }
       }
       LogHelper::saveLogData($args['customer_id'],$args,$response,'RegisterUpc');
       return $response;
      
    }
}

<?php
namespace App\GraphQL\Mutations;

use App\Models\CustomerValuePack;

use Illuminate\Support\Facades\Log;
use App\Helpers\LogHelper;

class CreateValuePack
{
    /** Used for update or create prefernece list
     * @param  null  $args
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args) {
       try
        {
            $response=[];
            $id=0;
            $id = LogHelper::saveLogData($args['customer_id'], $args, $response, 'CreateValuePack');
            if($args['vp1'] == 0){
              $valuepack1=null;
            }
            else{
              $valuepack1=$args['vp1'];
            }

            if($args['vp2'] == 0){
              $valuepack2=null;
            }
            else{
              $valuepack2=$args['vp2'];
            }

            if($args['vp3'] == 0){
              $valuepack3=null;
            }
            else{
              $valuepack3=$args['vp3'];
            }
            $checkvaluedata=CustomerValuePack::where('customer_id',$args['customer_id'])->get()->count();
          
            if($checkvaluedata>0){
                $data=[
                    'value_pack_1'=>$valuepack1,
                    'value_pack_2'=>$valuepack2,
                    'value_pack_3'=>$valuepack3

                ];
                
                CustomerValuePack::where('customer_id',$args['customer_id'])->update($data);
            }
            else{
              $data=[
                    'value_pack_1'=>$valuepack1,
                    'value_pack_2'=>$valuepack2,
                    'value_pack_3'=>$valuepack3,
                    'customer_id'=>$args['customer_id'],

              ];
              CustomerValuePack::create($data);

            }
            return $response=[
              'vp1'=>$args['vp1'],
              'vp2'=>$args['vp2'],
              'vp3'=>$args['vp3'],
              'customer_id'=>$args['customer_id'],
              'code'=>200,
              'comment'=>"Data Updated Successfully"
          ];
          LogHelper::updateLogData($id, $args['customer_id'], $args, $response, 'CreateValuePack');
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


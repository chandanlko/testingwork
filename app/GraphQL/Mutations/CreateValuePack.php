<?php
namespace App\GraphQL\Mutations;

use App\Models\CustomerValuePack;

use Illuminate\Support\Facades\Log;

class CreateValuePack
{
    /** Used for update or create prefernece list
     * @param  null  $args
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args) {
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
              'customer_id'=>$args['customer_id']
        ];
        CustomerValuePack::create($data);

      }
      return $response=[
        'vp1'=>$args['vp1'],
        'vp2'=>$args['vp2'],
        'vp3'=>$args['vp3'],
        'customer_id'=>$args['customer_id']
    ];
    }
}


<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

use App\Models\CustomerValuePack;
use App\Models\ValuesPack;
use App\Models\ValuePackScore;

class GetScore extends Model
{
    use HasFactory;
     /** Used to get scoring by customer id to compare the data
     * @param  null $customerid,$parentid
     * @param  array<string, mixed>  $args
     */
    static public function scoringbyparent_id($customerid,$parentid){
        try {
            $valuepackcount=[];
            $customerdata=CustomerValuePack::where('customer_id',$customerid)->first();
            if(!empty($customerdata)){
                
                if(!empty($customerdata->value_pack_1) || $customerdata->value_pack_1 !=null){
                    $valuepackcount[]=$customerdata->value_pack_1;
                }
                if(!empty($customerdata->value_pack_2) || $customerdata->value_pack_2 !=null){
                    $valuepackcount[]=$customerdata->value_pack_2;
                }
                if(!empty($customerdata->value_pack_3) || $customerdata->value_pack_3 !=null){
                    $valuepackcount[]=$customerdata->value_pack_3;
                }
              
                if(count($valuepackcount)>0){
                    $formula=0;
                    switch(count($valuepackcount)){
                        case 1:
                            $score1= ValuePackScore::where(['parent_id'=>$parentid,'value_pack_id'=>$valuepackcount[0]])->first();
                            $formula=(1.0*$score1->score);
                            break;
                        case 2:
                            $score1= ValuePackScore::where(['parent_id'=>$parentid,'value_pack_id'=>$valuepackcount[0]])->first(); 
                            $score2= ValuePackScore::where(['parent_id'=>$parentid,'value_pack_id'=>$valuepackcount[1]])->first();
                            $formula=(0.67*$score1->score)+(0.33*$score2->score);
                            break;
                        case 3:
                            $score1= ValuePackScore::where(['parent_id'=>$parentid,'value_pack_id'=>$valuepackcount[0]])->first(); 
                            $score2= ValuePackScore::where(['parent_id'=>$parentid,'value_pack_id'=>$valuepackcount[1]])->first();
                            $score3= ValuePackScore::where(['parent_id'=>$parentid,'value_pack_id'=>$valuepackcount[2]])->first();
                            $formula=(0.57*$score1->score)+(0.29*$score2->score)+(0.14*$score3->score);
                        break;
                            break;
                        default:
                        $formula=0;
                        break;

                    }
                    return $formula;
                    
                }
                else{
                    Log::info('Error in App\Models\GetScore ', ['line' =>"", 'error' =>"Value Pack data missing."]);
                    return 0;
                }
                
        }
        else {
           Log::info('Error in App\Models\GetScore ', ['line' =>"", 'error' =>"Customer data missing."]);
                    return 0;
        }
        } catch(\Exception $e) {
            Log::info('Error in App\Models\GetScore ', ['line' => $e->getLine(), 'error' => $e->getMessage() ]);
            return 0;
        }
}
}
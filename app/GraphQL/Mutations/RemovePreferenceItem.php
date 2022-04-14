<?php

namespace App\GraphQL\Mutations;

use App\Models\PreferenceList;
use App\Helpers\LogHelper;

class RemovePreferenceItem
{
    /**  used this mutation to delete a particular prefrence data.
     * @param  
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
       
        try {
            $res=[];
            $id=0;
             $id= LogHelper::saveLogData('',$args,$res,'RemovePreferenceItem');
        	if(isset($args['primary_id']) && !empty($args['primary_id'])){
            $PreferenceList=PreferenceList::where('id',$args['primary_id'])->first();
            if($PreferenceList){
                PreferenceList::where('id',$args['primary_id'])->delete();
                $res=['code'=>200, 'comment'=>"Deleted Successfully!"];
            }else{
                 $res=['code'=>202, 'comment'=>"primary_id is not available"];
            }
	        }
	        else{
	        	$res=['code'=>202, 'comment'=>"Please enter Valid id"];
	        }
            LogHelper::updateLogData($id,'',$args,$res,'RemovePreferenceItem');
	        return $res;
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

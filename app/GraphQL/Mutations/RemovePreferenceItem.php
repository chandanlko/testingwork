<?php

namespace App\GraphQL\Mutations;

use App\Models\PreferenceList;

class RemovePreferenceItem
{
    /**  used this mutation to delete a particular prefrence data.
     * @param  
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        try {
        	 if(isset($args['primary_id']) && !empty($args['primary_id'])){
        	PreferenceList::where('id',$args['primary_id'])->delete();
	        	$res=['code'=>200, 'comment'=>"Deleted Successfully!"];
	        }
	        else{
	        	$res=['code'=>202, 'comment'=>"Enter Valid id"];
	        }
	        return $res;
        }
        catch (\Exception $e) {
            Log::info('Error in Graphql\Mutation\RemovePreferenceItem ', ['line'=>$e->getLine(),'error'=>$e->getMessage()]);
            return ['code'=>202, 'comment'=>$e->getLine().$e->getMessage()];
        }
       
    }
}

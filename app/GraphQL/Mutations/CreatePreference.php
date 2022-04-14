<?php
namespace App\GraphQL\Mutations;
use App\Models\PreferenceList;
use App\Models\Brand;
use App\Models\ParentModel;
use Illuminate\Support\Facades\Log;
use App\Helpers\LogHelper;

class CreatePreference
{
    /** Used for update or create prefernece list
     * @param  null  $args
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args) {
        try {
            $brandname = Brand::where('brand_name', $args['brand'])->first();
            $parentname = ParentModel::where('parent_name', $args['parent'])->first();
           
            $data = [
                'customer_id' => $args['customer_id'], 
                'brand_id' => $brandname['brand_id'], 
                'parent_id' => $parentname['parent_id'], 
                'type' => $args['type']
            ];
            $checkexistance = PreferenceList::where(['customer_id' => $args['customer_id'],'parent_id'=>$parentname['parent_id']])->first();
            if (!empty($checkexistance)) {
                PreferenceList::where('id', $checkexistance['id'])->update($data);
            } else {
                PreferenceList::create($data);
            }
            $response['preference'] = ['code' => 200, 'comment' => 'Preference List Updated Successfully', 'type' => $args['type']];
            return $response;
            LogHelper::saveLogData($args['customer_id'],$args,$response,'CreatePreference');
        }
        catch(\Exception $e) {
            Log::info('Error in Graphql\Mutation\CreatePreference ', ['line' => __LINE__, 'error' => $e->getMessage() ]);
            $response['preference'] = ['code' => 500, 'comment' => '"Something went wrong. Please try again', 'type' => $args['type']];
        }
    }
}


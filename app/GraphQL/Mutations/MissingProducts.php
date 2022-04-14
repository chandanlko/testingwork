<?php

namespace App\GraphQL\Mutations;

use App\Models\MissingProduct;
use App\Helpers\LogHelper;

class MissingProducts
{
  /**
   * @param  null  $_
   * @param  array<string, mixed>  $args
   */
  public function __invoke($_, array $args)
  {
    try {
      $response = [];
      $id = 0;
      $id = LogHelper::saveLogData($args['customer_id'], $args, $response, 'RegisterUpc');
      if (empty($args['customer_id']) || empty($args['upc'])) {
        $response = ['code' => 202, 'comment' => "customer_id or upc is empty"];
      } else {
        $checkUpc = MissingProduct::where('customer_id', $args['customer_id'])->where('upc', $args['upc'])->get();
        if ($checkUpc->count() > 0) {
          MissingProduct::where('id', $checkUpc[0]->id)->update($args);
          $response = ['code' => 200, 'comment' => "Upc & Image is submitted"];
        } else {
          MissingProduct::create($args);
          $response = ['code' => 200, 'comment' => "Upc & Image is submitted"];
        }
      }
      LogHelper::updateLogData($id, $args['customer_id'], $args, $response, 'RegisterUpc');
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

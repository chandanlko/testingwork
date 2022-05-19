<?php

namespace App\Http\Controllers;
// header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");

 

// header("Pragma: no-cache");

// ini_set('memory_limit', '-1');



use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}

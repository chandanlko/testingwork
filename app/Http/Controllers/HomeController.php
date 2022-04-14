<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Models\GetScore;
use App\Models\Brand;
use App\Models\ParentModel;
use App\Models\CatHierarchy;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**instance
     *  Create a new controller .
     *
     * @return void
     */
    public function __construct()
    {
      // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        
    }

    public function insert(){
     return DB::table('customers')->get();
       
    }
      //return $data

  }

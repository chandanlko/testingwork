<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect("/login");
});
Route::get('/login', function () {
    return view('auth.login');
});

Route::get('/register', function () {
    return view('auth.register');
});

Auth::routes();
Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    });
    Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');
});

 Route::get('categories', '\App\Http\Controllers\CategoryController@index');
 Route::get('categoryadd', '\App\Http\Controllers\CategoryController@categoryadd');
 Route::post('savecategory', '\App\Http\Controllers\CategoryController@savecategory');
 Route::get('categoryedit/{id}', '\App\Http\Controllers\CategoryController@categoryedit');
 Route::get('categorydelete/{id}', '\App\Http\Controllers\CategoryController@categorydelete');
 

 Route::get('customers', '\App\Http\Controllers\CustomerController@index');
 Route::get('customeradd', '\App\Http\Controllers\CustomerController@customeradd');
 Route::post('savecustomer', '\App\Http\Controllers\CustomerController@savecustomer');
 Route::get('customeredit/{id}', '\App\Http\Controllers\CustomerController@customeredit');
 Route::get('customerdelete/{id}', '\App\Http\Controllers\CustomerController@customerdelete');
 
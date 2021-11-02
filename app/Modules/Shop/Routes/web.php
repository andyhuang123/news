<?php
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your module. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/
Route::prefix('shop')->group(function () {

    Route::get('/', 'TestController@index');
    
    Route::get('index', 'TestController@index');
   
    Route::get('jiukuai', 'TestController@jiukuai');
    
    Route::get('search', 'TestController@search');
});
 
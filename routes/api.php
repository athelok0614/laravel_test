<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/
Route::post('user/register','MemberController@store');
//Route::post('user/login','MemberController@login');
Route::group([

    'prefix' => 'auth.jwt'

], function ($router) {
    
    Route::post('user/login', 'MemberController@login');
    Route::post('user/message', 'MemberController@message');
    /*
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    */
    

});

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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('user/register')->uses('UserController@register')->name('users.register');
Route::post('user/login')->uses('UserController@login')->name('users.login');
Route::middleware('jwt.auth')->post('user/message')->uses('UserController@message')->name('users.message');
Route::middleware('jwt.auth')->post('user/message/reply')->uses('UserController@reply')->name('users.reply');
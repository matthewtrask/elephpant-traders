<?php

use Illuminate\Http\Request;

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

Route::get('elephpants', ['uses' => 'Api\PostingsController@index']);
Route::get('elephpants/post/{id}', ['uses' => 'Api\PostingsController@show'])->where('id', '[0-9]+');
Route::get('elephpants/sellers/{id}', ['uses' => 'Api\SellersController@show'])->where('id', '[0-9]+');

Route::group(['middleware' => 'jwt.auth'], function() {
    Route::get('user', ['uses' => 'Api\UsersController@show']);
});
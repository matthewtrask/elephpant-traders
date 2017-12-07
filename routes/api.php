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
Route::delete('elephpants/remove/{id}', ['uses' => 'Api\PostingsController@destroy'])->where('id', '[0-9]+');
Route::post('elephpants/image', ['uses' => 'Api\ImageController@create']);
Route::post('elephpants', ['uses' => 'Api\PostingsController@create']);
Route::post('elephpants/wishlist', ['uses' => 'Api\WishlistController@create']);
Route::delete('elephpants/wishlist/{id}', ['uses' => 'Api\WishlistController@destroy'])->where('id', '[0-9]+');
Route::post('elephpants/trade', ['uses' => 'Api\TradeController@create']);
Route::put('elephpants/trade', ['uses' => 'Api\TradeController@edit']);
Route::delete('elephpants/trade/{tradeId}', ['uses' => 'Api\TradeController@destroy'])->where('tradeId', '[0-9]+');

Route::post('register', ['uses' => 'Api\AuthController@register']);
Route::post('login', ['uses' => 'Api\AuthController@create']);


Route::get('user', ['uses' => 'Api\UsersController@show'])->middleware('auth:api');


/**
 * Social Auth
 */

Route::get('login/facebook', ['uses' => 'Api\Auth\FacebookController@facebookLogin']);
Route::get('login/facebook/callback', ['uses' => 'Api\Auth\FacebookController@handleFacebookCallback']);
Route::get('login/twitter', ['uses' => 'Api\Auth\TwitterController@twitterLogin']);
Route::get('login/twitter/callback', ['uses' => 'Api\Auth\TwitterController@handleTwitterCallback']);
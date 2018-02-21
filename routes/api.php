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

Route::post('register', ['uses' => 'Api\AuthController@register']);
Route::post('login', ['uses' => 'Api\AuthController@create']);


Route::get('elephpants', ['uses' => 'Api\PostingsController@index']);
Route::get('elephpants/post/{id}', ['uses' => 'Api\PostingsController@show'])->where('id', '[0-9]+');
Route::get('elephpants/sellers/{id}', ['uses' => 'Api\SellersController@show'])->where('id', '[0-9]+');
Route::put('elephpants/trade', ['uses' => 'Api\TradeController@edit']);
Route::delete('elephpants/trade/{tradeId}', ['uses' => 'Api\TradeController@destroy'])->where('tradeId', '[0-9]+');

Route::get('wishlist', ['uses' => 'Api\WishlistController@index']);


Route::get('user', ['uses' => 'Api\UsersController@show'])->middleware('auth:api');
Route::post('elephpants', ['uses' => 'Api\PostingsController@create'])->middleware('auth:api');
Route::delete('elephpants/remove/{id}', ['uses' => 'Api\PostingsController@destroy'])->where('id', '[0-9]+');
Route::post('elephpants/image', ['uses' => 'Api\ImageController@create'])->middleware('auth:api');
Route::post('elephpants/trade', ['uses' => 'Api\TradeController@create'])->middleware('auth:api');
Route::post('elephpants/wishlist', ['uses' => 'Api\WishlistController@create'])->middleware('auth:api');
Route::delete('elephpants/wishlist/{id}', ['uses' => 'Api\WishlistController@destroy'])->middleware('auth:api')->where('id', '[0-9]+');

/**
 * Social Auth
 */

Route::get('login/facebook', ['uses' => 'Api\Auth\FacebookController@facebookLogin']);
Route::get('login/facebook/callback', ['uses' => 'Api\Auth\FacebookController@handleFacebookCallback']);
Route::get('login/twitter', ['uses' => 'Api\Auth\TwitterController@twitterLogin']);
Route::get('login/twitter/callback', ['uses' => 'Api\Auth\TwitterController@handleTwitterCallback']);
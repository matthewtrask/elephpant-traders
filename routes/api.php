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


/* Socialite Routes */

// Facebook Route
Route::get('login/facebook', ['uses' => 'Api\AuthController@redirectToFacebook']);
Route::get('login/facebook/callback', ['uses' =>'Api\AuthController@handleFacebookCallback']);

//Twitter Route
Route::get('login/twitter', ['uses' =>'Api\AuthController@redirectToTwitter']);
Route::get('login/twitter/callback',['uses' => 'Api\AuthController@handleTwitterCallback']);

//Github Route
Route::get('login/github', ['uses' =>'Api\AuthController@redirectToGithub']);
Route::get('login/github/callback', ['uses' =>'Api\AuthController@handleGithubCallback']);



Route::group(['middleware' => 'jwt.auth'], function() {
    Route::get('user', ['uses' => 'Api\UsersController@show']);
});
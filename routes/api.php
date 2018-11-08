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

Route::group(['prefix' => 'user'], function () {
    Route::post('register', 'UserController@register');
});

Route::middleware('auth:api')->get('/user', function (Request $request) {
    $user = $request->user();
    return $user;
});

Route::middleware('auth:api')->group(function () {
    Route::resource('shop', 'ShopController');
    Route::resource('shop-photos', 'ShopPhotoController');
    Route::get('user-shops','ShopController@getUserShops');
});
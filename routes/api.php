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

Route::middleware('auth:api')->group(function () {
    //shop routes
    Route::resource('shop', 'ShopController');
    Route::resource('shop-photos', 'ShopPhotoController');
    Route::get('user-shops', 'ShopController@getUserShops');

    //user routes
    Route::get('user', 'UserController@getUser');
    Route::patch('user/{user}', 'UserController@update');
    Route::post('profile-photo/{user}', 'UserController@upload');

    //food routes
    Route::get('foods', 'FoodItemController@index');
    Route::resource('food-item', 'FoodItemController');
    Route::resource('food-photos', 'FoodPhotoController');
    Route::get('shop-foods/{shop_id}', 'FoodItemController@getShopFoods');

    //order routes
    Route::resource('order', 'OrderController');
});

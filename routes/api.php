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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['namespace' => '\App\Http\Controllers\Api'], function() {
    Route::get('/categories', 'CategoryController@index');
    Route::post('/categories', 'CategoryController@store');
    Route::patch('/categories/{categoryId}', 'CategoryController@update');
    Route::delete('/categories/{categoryId}', 'CategoryController@destroy');
    Route::get('/categories/{categoryId}', 'CategoryController@show');

    Route::get('/products', 'ProductController@index');
    Route::post('/products', 'ProductController@store');
    Route::patch('/products/{productId}', 'ProductController@update');
    Route::delete('/products/{productId}', 'ProductController@destroy');
    Route::get('/products/{productId}', 'ProductController@show');
});

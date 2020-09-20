<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::namespace('App\Http\Controllers\Api\v1')->group(function () {
    Route::post('/register', 'AuthController@register');
    Route::post('/login', 'AuthController@login');

});
Route::namespace('App\Http\Controllers\Api\v1')->middleware('auth:api')->group(function () {
    Route::post('/address', 'AuthController@address');
    Route::get('/info', 'AuthController@info');

    Route::get('/nearProduct', 'ProductController@nearProduct');
    Route::group(['prefix' => 'products'], function()
    {
        Route::get('index', 'ProductController@index');
        Route::post('create', 'ProductController@store');
        Route::post('edit/{product}', 'ProductController@update');
    });

    Route::group(['prefix' => 'sellers'], function()
    {
        Route::post('/add', 'SellerController@add');
        Route::get('/all', 'SellerController@sellers');
        Route::get('/seller/{id}', 'SellerController@seller');
    });


});

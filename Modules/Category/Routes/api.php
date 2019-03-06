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

Route::group(['prefix' => 'category'], function(){
    Route::put('/mass-update', 'CategoryController@massUpdate')->name('category.mass-update');
    Route::delete('/mass-delete', 'CategoryController@massDelete');
});

Route::apiResource('category', 'CategoryController');


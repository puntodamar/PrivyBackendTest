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

Route::resource('category', 'CategoryController');

// Route::group(['prefix' => 'category'], function(){
//     Route::get('/', 'CategoryController@index');
//     Route::post('/', 'CategoryController@store');
//     Route::put('/{id}', 'CategoryController@update');
//     Route::get('/{id}', 'CategoryController@show');
// });
<?php

use Illuminate\Http\Request;

Route::apiResource('product', 'ProductController')->except([
    'show'
]);

Route::group(['prefix' => 'product'], function(){
    Route::get('/{id}', 'ProductController@show');   
});
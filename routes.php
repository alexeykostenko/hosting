<?php

/*
|--------------------------------------------------------------------------
| Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
|
*/

use Classes\Route;

Route::post('images', 'ApiController@create');
Route::put('images', 'ApiController@update');
Route::delete('images', 'ApiController@delete');

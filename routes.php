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
Route::put('images/{id}', 'ApiController@update');
Route::delete('images/{id}', 'ApiController@delete');

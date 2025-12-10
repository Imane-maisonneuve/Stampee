<?php

use App\Routes\Route;
use App\Controllers\AuthController;


Route::get('/', 'AuctionController@index');

Route::get('/user/show', 'UserController@show');
Route::get('/user/create', 'UserController@create');
Route::post('/user/create', 'UserController@store');
Route::get('/user/edit', 'UserController@edit');
Route::post('/user/edit', 'UserController@update');
Route::post('/user/delete', 'UserController@setUserInactive');


Route::get('/login', 'AuthController@create');
Route::post('/login', 'AuthController@show');
Route::get('/logout', 'AuthController@delete');


Route::get('/stamp/create', 'StampController@create');
Route::post('/stamp/create', 'StampController@store');


Route::get('/image/create', 'ImageController@create');
Route::post('/image/create', 'ImageController@store');


Route::dispatch();

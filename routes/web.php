<?php

use App\Routes\Route;
use App\Controllers\SiteController;
use App\Controllers\ReservationController;
use App\Controllers\AuthController;
use App\Controllers\JournalController;

Route::get('/', 'AuctionController@index');
Route::get('/sites', 'SiteController@index');
Route::post('/site/delete', 'SiteController@delete');
Route::get('/site/edit', 'SiteController@edit');
Route::post('/site/edit', 'SiteController@update');
Route::get('/site/create', 'SiteController@create');
Route::post('/site/create', 'SiteController@store');


Route::get('/user/show', 'UserController@show');
Route::get('/user/create', 'UserController@create');
Route::post('/user/create', 'UserController@store');
Route::get('/user/edit', 'UserController@edit');
Route::post('/user/edit', 'UserController@update');

Route::get('/login', 'AuthController@create');
Route::post('/login', 'AuthController@show');
Route::get('/logout', 'AuthController@delete');


// Route::get('/clients', 'ClientController@index');
// Route::get('/client/show', 'ClientController@show');
// Route::get('/client/create', 'ClientController@create');
// Route::post('/client/create', 'ClientController@store');
// Route::get('/client/edit', 'ClientController@edit');
// Route::post('/client/edit', 'ClientController@update');
// Route::post('/client/delete', 'ClientController@delete');








Route::dispatch();

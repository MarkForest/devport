<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['middleware' => 'myAuth'], function() {
    Route::get('/', 'SiteController@cabinet');
    Route::get('/cabinet', 'SiteController@cabinet');
    Route::get('/link/{link}', 'SiteController@linkShow');
    Route::post('/random', 'SiteController@random');
    Route::post('/history', 'SiteController@history');
    Route::post('/link/new', 'SiteController@linkNew');
    Route::post('/link/deactivate', 'SiteController@deactivate');
    Route::get('/logout', 'AuthController@logout');
});

Route::group(['middleware' => 'myQuest'], function() {
    Route::get('/register', 'AuthController@registerForm');
    Route::post('/register', 'AuthController@register');
});



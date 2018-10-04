<?php

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

Route::get('/',
    ['as' => '/', 'uses' => 'HomeController@index']);
    
Route::get('home',
    ['as' => 'home', 'uses' => 'HomeController@indexHome']);

//ajax
Route::post('login-nick',
    ['as' => 'login_nick', 'uses' => 'HomeController@postLogIn']);
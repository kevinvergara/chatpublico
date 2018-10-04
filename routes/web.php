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

Route::post('cargar-post',
    ['as' => 'cargar_post', 'uses' => 'HomeController@cargarPosts']);
    
Route::post('cargar-chat',
    ['as' => 'cargar_chat', 'uses' => 'HomeController@cargarChat']);
    
Route::post('guardar-comentario',
    ['as' => 'guardar_comentario', 'uses' => 'HomeController@guardarComentario']);
<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/index',"IndexController@index");


Route::group(['middleware' => 'web'], function () {
    Route::match(['get','post'],'/admin/login',"Admin\LoginController@login");
});
Route::group(['middleware' => ['web','adminlogin'],"prefix"=>'admin','namespace'=>'Admin'], function () {
    Route::get('index',"IndexController@index");
    Route::get('info',"IndexController@info");
    Route::get('logout',"LoginController@logout");
    Route::match(['get','post'],'pass',"AdminController@pass");

    Route::resource('category/changeOrd', 'CategoryController@changeOrd');
    Route::resource('category', 'CategoryController');
});
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

Route::get('/', 'PagesController@index');
Route::get('/about', 'PagesController@about');
Route::get('/services', 'PagesController@services');
Route::get('/dashboard', 'DashboardController@index');
Route::get('/playerdashboard', 'PlayerDashboardController@index');
Route::get('/search', 'PostsController@search')->name('search');
Route::get('/search', 'ProfilesController@search')->name('search');
Route::get('/admin', 'AdminController@admin')->middleware('is_admin')->name('admin');

Route::post('/dashboard', ['uses' => 'PostsController@hidePost']);

Route::resource('posts', 'PostsController');
Route::resource('profiles', 'ProfilesController');

Auth::routes();



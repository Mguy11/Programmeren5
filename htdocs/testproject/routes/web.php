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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/categories', function () {
    return view('categories');
});

Route::get('/beheer', function () {
    return view('beheer');
});

Route::get('/advertenties', function () {
    return view('advertenties');
});
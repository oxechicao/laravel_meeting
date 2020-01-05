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
    return view('auth/register');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/user/index', 'UserController@index')->name('user.index');
Route::put('/user/update/{id}', 'UserController@update')->name('user.update');

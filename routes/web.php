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
})->middleware(['web', 'guest']);

Auth::routes();

Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/user/profile', 'UserController@index')->name('user.index');
    Route::put('/user/update/{id}', 'UserController@update')->name('user.update');

    Route::get('/contacts', 'ContactController@index')->name('contact.index');
    Route::get('/contacts/all', 'ContactController@getAll')->name('contact.all');
    Route::post('/contacts/store', 'ContactController@store')->name('contact.store');
    Route::put('/contacts/update/{id?}', 'ContactController@update')->name('contact.update');
    Route::delete('/contacts/destroy/{contact?}', 'ContactController@destroy')->name('contact.destroy');

    Route::get('/agendas', 'AgendaController@index')->name('agenda.index');
    Route::get('/agendas/all', 'AgendaController@getAll')->name('agenda.all');
    Route::get('/agendas/all/next', 'AgendaController@getAllNextDays')->name('agenda.all.next');
    Route::post('/agendas/store', 'AgendaController@store')->name('agenda.store');
    Route::put('/agendas/update/{agenda?}', 'AgendaController@update')->name('agenda.update');
    Route::delete('/agendas/destroy/{agenda?}', 'AgendaController@destroy')->name('agenda.destroy');
});



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

Route::get('/users', 'UserController@index')
    ->name('users');

Route::get('/users/{user}', 'UserController@show')
    ->where('user', '[0-9]+')
    ->name('users.show');

Route::get('/users/new', 'UserController@new')
    ->name('users.new');

Route::post('/users/create', 'UserController@store');

Route::get('/users/{user}/edit', 'UserController@edit')
    ->name('users.edit');

Route::put('/users/{user}', 'UserController@update')
    ->name('users.update');

Route::get('/hello/{name}/{nickname?}', 'WelcomeUserController')
    ->name('hello');

Route::delete('/users/{user}', 'UserController@destroy')
    ->name('users.destroy');
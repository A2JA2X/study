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
    return 'Home';
});

Route::get('/users', 'UserController@index')
    ->name('users');

Route::get('/users/{id}', 'UserController@show')
    ->where('id', '[0-9]+')
    ->name('users.show');

Route::get('/users/new', 'UserController@new')
    ->name('users.new');

Route::get('/users/create', 'UserController@create')
    ->name('users.create');

Route::get('/hello/{name}/{nickname?}', 'WelcomeUserController')
    ->name('hello');
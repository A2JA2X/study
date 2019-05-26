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

Route::get('users', function (){
    return 'Users';
});

// ルーティングがかぶる場合の解決法１idは数字だけを受け付けるようにする
//Route::get('users/{id}', function ($id){
//   return "Details for user: {$id}";
//})->where('id', '[0-9]+');

// ルーティングがかぶる場合の解決法２順番を変える
Route::get('users/new', function (){
   return 'Create new user';
});

Route::get('users/{id}', function ($id){
   return "Details for user: {$id}";
});

// 複数引数
//Route::get('hello/{name}/{nickname}', function ($name, $nickname){
//   return "Hi, {$name}. your nickname is: {$nickname}";
//});

// 複数引数条件付き
Route::get('hello/{name}/{nickname?}', function ($name, $nickname = null){
    if ($nickname) {
        return "Hi, {$name}. your nickname is: {$nickname}";
    } else {
        return "Hi, {$name}. nickname is not defined!";
    }
});
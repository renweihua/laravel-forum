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
use Illuminate\Support\Facades\Route;

Route::prefix('')->group(function() {
    Route::get('/users', 'UsersController@users')->name('users');
    Route::get('/user-group', 'UserGroupController@group')->name('user-group');
    Route::resource('users', 'UsersController', ['only' => ['show', 'update', 'edit']]);
    Route::prefix('user')->middleware('auth')->group(function() {
        // 签到日志
        Route::get('sign-logs', 'IndexController@signs')->name('sign.logs');
    });
});

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
    Route::get('/', 'HomeController@index')->name('home');

    // 查看已有的功能列表
    Route::get('functions', 'HomeController@functions')->name('functions');
    Route::get('get-functions', 'HomeController@getFunctions')->name('get-functions');

    Route::get('/search', 'HomeController@index')->name('search');

    Route::resource('dynamics', 'DynamicsController', ['only' => ['create', 'store', 'update', 'edit', 'destroy']]);
    Route::get('dynamics/{dynamic}/{slug?}', 'DynamicsController@show')->name('dynamics.show');

    Route::resource('notifications', 'NotificationsController', ['only' => ['index']]);
});

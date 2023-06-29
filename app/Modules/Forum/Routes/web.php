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
    Route::get('/search', 'HomeController@index')->name('search');


    Route::get('/dynamic/{dynamic}', 'DynamicController@show')->name('dynamic.show');
    Route::get('/dynamic/{dynamic}/edit', 'DynamicController@edit')->name('dynamic.edit');
    Route::get('/dynamic.create', 'DynamicController@create')->name('dynamic.create');
    Route::post('/dynamic', 'DynamicController@store')->name('dynamic.store');
    Route::put('/dynamic/{dynamic}', 'DynamicController@update')->name('dynamic.update');
    Route::delete('/dynamic/{dynamic}', 'DynamicController@destroy')->name('dynamic.destroy');

    Route::resource('notifications', 'NotificationsController', ['only' => ['index']]);
});

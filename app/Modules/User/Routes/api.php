<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('')->middleware('auth:api')->group(function() {
    Route::prefix('user')->group(function () {
        Route::post('follow', 'FriendsController@follow')->name('user.follow');
        // 今日签到信息
        Route::get('getSignByToday', 'SignsController@getSignByToday');
        // 每日签到
        Route::post('sign-in', 'SignsController@signIn');
        // 指定月份的签到状态
        Route::get('getSignsStatusByMonth', 'SignsController@getSignsStatusByMonth');
    });
});

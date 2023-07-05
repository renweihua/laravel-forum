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

// Route::middleware('auth:api')->get('/forum', function (Request $request) {
//     return $request->user();
// });

Route::prefix('')->group(function() {
    Route::post('upload', 'UploadController@file')->name('upload.file');
    Route::post('dynamics/collection', 'DynamicsApiController@collection')->name('dynamics.collection');
    Route::post('dynamics/praise', 'DynamicsApiController@praise')->name('dynamics.praise');
});

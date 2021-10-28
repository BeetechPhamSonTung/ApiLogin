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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// JWT
Route::post('auth/register', '\App\Http\Controllers\ApiTestController@register');
Route::post('auth/login', '\App\Http\Controllers\ApiTestController@login');
Route::group(['middleware' => 'jwt.auth'], function () {
    Route::get('user-info', '\App\Http\Controllers\ApiTestController@getUserInfo');
});

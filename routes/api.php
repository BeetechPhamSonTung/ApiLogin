<?php

use App\Http\Controllers\ApiController;
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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', [ApiController::class, 'login'])->name('login');
    Route::post('signup', [ApiController::class, 'signup']);

//    Route::group([
//        'middleware' => 'auth:api'
//    ], function() {
//        Route::get('logout', [ApiController::class, 'logout']);
//        Route::get('user', [ApiController::class, 'user']);
//    });
//    Route::middleware(['api'])->group(function () {
        Route::get('logout', [ApiController::class, 'logout']);
        Route::get('user', [ApiController::class, 'user'])->middleware('auth');
//    });
});

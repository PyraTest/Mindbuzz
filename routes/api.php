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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
Route::group(['namespace' => 'Api', 'prefix' => 'game'], function () {
    Route::get('/get_games_by_type/{id}', 'GameController@getGamesByType');
    Route::get('/game_info/{id}', 'GameController@indexGame');
    Route::post('/attempt', 'GameController@attempt');
    // Route::post('/login', 'AuthController@login');
    // Route::post('/salon-login', 'AuthController@salonLogin');

});
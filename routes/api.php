<?php

use Illuminate\Http\Request;
use App\Http\Controllers\AdsController;
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
Route::prefix('/v1')->group(function () {
    Route::get('/', fn() => app()->version());

    Route::get('/ad', [AdsController::class, 'get']);
    Route::get('/ads', [AdsController::class, 'index']);
    Route::post('/ad', [AdsController::class, 'store']);
});
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

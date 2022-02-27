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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});
Route::controller(\App\Http\Controllers\Api\PaymentController::class)->group(function () {

    Route::post('/validation', 'validation');
    Route::post('/auth', 'authOnly');
    Route::post('/capture', 'capture');
    Route::post('/sale', 'sale');
    Route::post('/refund', 'refund');
    Route::post('/epage', 'epage');

//    Route::post('/verify', 'verify');
});


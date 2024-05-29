<?php

use App\Http\Controllers\ClassmentController;
use App\Http\Controllers\MatchController;
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

Route::get('/test', function(Request $request) {
    return "test";
});


Route::prefix('matches')->group(function(){
    Route::post('/store',[MatchController::class, 'store']);
});

Route::prefix('classments')->group(function(){
    Route::get('/', [ClassmentController::class, 'index']);
});
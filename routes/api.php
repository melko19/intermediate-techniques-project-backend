<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticateController;
use App\Http\Controllers\MangaController;

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

Route::post('/login', [AuthenticateController::class, 'login']);
Route::post('/register',[AuthenticateController::class, 'register']);

Route::group(['middleware'=>'auth:api'], function(){
    Route::get('/user',[AuthenticateController::class, 'userItself']);
    Route::post('/logout',[AuthenticateController::class, 'logout']);

    Route::post('/mangas/search', [MangaController::class, 'search']);
    Route::post('/mangas', [MangaController::class, 'store']);
    Route::get('/mangas', [MangaController::class, 'index']);
    Route::get('/mangas/{manga}', [MangaController::class, 'show']);
    Route::put('/mangas/{manga}', [MangaController::class, 'update']);
    Route::delete('/mangas/{manga}', [MangaController::class, 'destroy']);
});

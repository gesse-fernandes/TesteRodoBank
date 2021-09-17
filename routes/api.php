<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\FreightController;
use App\Http\Controllers\Api\UserController;
use App\Models\Freight;
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


Route::get('/freight/listar',[FreightController::class,'index']);
Route::get('/401',[AuthController::class, 'unauthorized']);
Route::post('/auth/login',[AuthController::class,'login']);


Route::middleware('auth:api')->group(function(){
    Route::group(['middleware'=>['role:admin']],function(){
        Route::post('/freight/criar', [FreightController::class, 'store'])->name('freight.create');
        Route::get('/freight/listar', [FreightController::class, 'index'])->name('freight.list');
        Route::get('/user/listar',[UserController::class,'index'])->name('users.list');
    });
});

Route::middleware('auth:api')->group(function(){
    Route::group(['middleware'=>['role:client']],function(){

    });
});

Route::middleware('auth:api')->group(function(){
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::post('/auth/refresh', [AuthController::class, 'refresh']);
});

Route::post('/user/criar',[UserController::class,'store'])->name('users.create');

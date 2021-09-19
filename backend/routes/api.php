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



Route::middleware('auth:api')->group(function(){
    Route::group(['middleware'=>['role:admin']],function(){

        Route::post('/user/pesquisar',[UserController::class, 'findByuser'])->name('users.findUser');
        Route::post('/freight/pesquisar',[FreightController::class, 'findByVehile_owner'])->name('freight.findByvehicle_owner');
        Route::resource('freight', FreightController::class);
        Route::resource('user',UserController::class);
    });
});

Route::middleware('auth:api')->group(function(){
    Route::group(['middleware'=>['role:client']],function(){
        Route::get('/freight/user/listar',[FreightController::class,'listFreightClient']);
    });
});

Route::middleware('auth:api')->group(function(){
    Route::post('/auth/logout', [AuthController::class, 'logout']);
    Route::post('/auth/refresh', [AuthController::class, 'refresh']);
    Route::get('/user/{id}',[UserController::class,'show'])->name('users.show');
    Route::put('/user/atualizar/{id}',[UserController::class,'update'])->name('users.update');
});
Route::get('/401', [AuthController::class, 'unauthorized']);
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/freight/pesquisarPlaca',[FreightController::class, 'findByBoard'])->name('freight.board');
Route::get('me',[AuthController::class, 'getAuthenticatedUser']);
Route::post('/user/criar',[UserController::class,'store']);

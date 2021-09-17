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
        Route::post('/freight/criar', [FreightController::class, 'store'])->name('freight.create');
        Route::get('/freight/listar', [FreightController::class, 'index'])->name('freight.list');
        Route::get('/user/listar',[UserController::class,'index'])->name('users.list');
        Route::delete('/user/deletar/{id}',[UserController::class,'destroy'])->name('users.destroy');
        Route::post('/user/pesquisar',[UserController::class, 'findByuser'])->name('users.findUser');
        Route::get('/freight/{id}',[FreightController::class,'show'])->name('freight.show');
        Route::put('/freight/atualizar/{id}',[FreightController::class,'update'])->name('freight.update');
        Route::delete('/freight/deletar/{id}',[FreightController::class,'destroy'])->name('freight.destroy');
        Route::post('/freight/pesquisar',[FreightController::class, 'findByVehile_owner'])->name('freight.findByvehicle_owner');
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

Route::post('/user/criar',[UserController::class,'store'])->name('users.create');
Route::get('/401', [AuthController::class, 'unauthorized']);
Route::post('/auth/login', [AuthController::class, 'login']);
Route::post('/freight/pesquisarPlaca',[FreightController::class, 'findByBoard'])->name('freight.board');

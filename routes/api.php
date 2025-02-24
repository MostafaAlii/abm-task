<?php
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api;


Route::prefix('auth')->controller(Api\AuthController::class)->group(function(){
    Route::post('register', 'register');
    Route::post('login', 'login');
});

Route::middleware('auth:sanctum')->group( function () {
    Route::prefix('auth')->group(function () {
        Route::post('logout', [Api\AuthController::class, 'logout']);    
    });
    //Route::prefix('tasks')->group(function () {   
        Route::apiResource('tasks', Api\TaskController::class); 
    //});
});
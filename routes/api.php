<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Laptop\LaptopController;


Route::prefix('auth')->group(function(){
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
});

Route::middleware('jwtauth')->group(function(){
    Route::get('me', [AuthController::class, 'me']);
    Route::get('logout', [AuthController::class, 'logout']);
    Route::get('refresh', [AuthController::class, 'refresh']);

    Route::get('laptops', [LaptopController::class, 'index']);
    Route::post('laptops', [LaptopController::class, 'store']);
    Route::get('laptops/{laptop}', [LaptopController::class, 'show']);
    Route::put('laptops/{laptop}', [LaptopController::class, 'update']);
    Route::delete('laptops/{laptop}', [LaptopController::class, 'destroy']);
});







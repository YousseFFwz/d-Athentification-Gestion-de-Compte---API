<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

route::post('registre' , [AuthController::class , 'registre']);
route::post('login' , [AuthController::class , 'login']);
route::post('logout' , [AuthController::class , 'logout'])->middleware('auth:sanctum');
route::get('profile' , [ProfileController::class , 'show'])->middleware('auth:sanctum');
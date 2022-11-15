<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



Route::post("/login",[App\Http\Controllers\AuthController::class,"login"]);
Route::post("/register",[App\Http\Controllers\AuthController::class,"register"]);
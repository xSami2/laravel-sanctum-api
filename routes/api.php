<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Public routes
Route::post('/login' , [AuthController::class , 'login']);
Route::post('/register' , [AuthController::class , 'register']);


// Protected Routes



Route::group(['middleware' => ['auth:sanctum']], function(){
     Route::resource('/tasks' , TaskController::class);
     Route::post('/logout' ,[AuthController::class , 'logout']);

});

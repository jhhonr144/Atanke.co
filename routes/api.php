<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\RolesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/ok', [LoginController::class, 'ok'])->name('ok');
    Route::resource('/roles',RolesController::class);
    Route::get('/user',[UsersController::class,'listarP']);
    Route::post('/users/upload-image',[ UsersController::class, 'uploadImage']);
  
   
});
Route::get('/no', [LoginController::class, 'no'])->name('no');
Route::post('/login',[LoginController::class,'login'])->name('login');
Route::post('/user/nuevo',[LoginController::class,'registro']);
Route::get('/salir', [LoginController::class, 'salir']);



/* 
Route::middleware('auth:api')->post('/users/upload-image', 'UserController@uploadImage'); */

//Route::middleware('auth:web')->post('/users/upload-image', 'UserController@uploadImage');


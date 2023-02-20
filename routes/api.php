<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PermisosController;
use App\Http\Controllers\RolesController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/ok', [LoginController::class, 'ok'])->name('ok');
});
Route::get('/no', [LoginController::class, 'no'])->name('no');

Route::resource('/roles',RolesController::class);
Route::post('/user/nuevo',[LoginController::class,'registro']);
Route::post('/login',[LoginController::class,'login'])->name('login');
Route::post('/salir', [LoginController::class, 'salir']);

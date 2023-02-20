<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PermisosController;
use App\Http\Controllers\RolesController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::resource('/roles',RolesController::class);
Route::post('/user/nuevo',[LoginController::class,'registro']);
Route::post('/user',[LoginController::class,'login'])->name('login');  

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/salir', [LoginController::class, 'salir'])->name('salir');
});
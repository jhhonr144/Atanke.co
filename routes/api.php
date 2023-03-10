<?php

use App\Http\Controllers\LecturasController;
use App\Http\Controllers\LecturasTipoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PalabrasController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\RolesController; 
use App\Http\Controllers\traducirPalabras\traducirPalabrasController; 
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/ok', [LoginController::class, 'ok'])->name('ok');
    Route::resource('/roles',RolesController::class); 
    Route::get('/misPermisos',[RolesController::class,'misPermiso']);
    Route::get('/user',[UsersController::class,'listarP']); 
    Route::post('/users/upload-image',[ UsersController::class, 'uploadImage']);
    
    Route::get('/Lecturas',[LecturasController::class,'listar']); 
    Route::get('/Categorias',[LecturasTipoController::class,'index']); 
    Route::get('/palabras',[PalabrasController::class,'listar']); 
   
});
Route::get('/no', [LoginController::class, 'no'])->name('no');
Route::post('/login',[LoginController::class,'login'])->name('login');
Route::post('/user/nuevo',[LoginController::class,'registro']);
Route::get('/salir', [LoginController::class, 'salir']);
//traducir palabras
Route::post('/traducir', [traducirPalabrasController::class,'traducir']);

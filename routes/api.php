<?php
use App\Http\Controllers\LecturaContenidoController;
use App\Http\Controllers\LecturasController;
use App\Http\Controllers\LecturasSessionController;
use App\Http\Controllers\LecturasTipoController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MultimediasController;
use App\Http\Controllers\PalabrasController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\RolesController; 
use App\Http\Controllers\TipoContenidoController;
use App\Http\Controllers\traducirPalabras\traducirPalabrasController; 
use App\Http\Controllers\User\updated\userUpdated;
use App\Http\Controllers\updateuser\updateUserController;
use Illuminate\Support\Facades\Route;


Route::middleware('auth:sanctum')->group(function () {
    Route::get('/ok', [LoginController::class, 'ok'])->name('ok');
    Route::resource('/roles',RolesController::class); 
    Route::get('/misPermisos',[RolesController::class,'misPermiso']);

    Route::get('/user',[UsersController::class,'listarP']); 
    Route::post('/users/upload-image',[ UsersController::class, 'uploadImage']);
    Route::put('/user',[userUpdated::class,'update']); 
    Route::put('/user/rol',[userUpdated::class,'updateRol']); 
    
    Route::get('/Lecturas',[LecturasController::class,'listar']); 
    Route::post('/Lecturas',[LecturasController::class,'create']); 
    Route::put('/Lecturas',[LecturasController::class,'update']); 
    Route::post('/LecturasFoto',[LecturasController::class,'foto']); 
    Route::delete('/Lecturas',[LecturasController::class,'delete']); 

    Route::post('/Multimedia',[MultimediasController::class,'create']); 

    Route::get('/Categorias',[LecturasTipoController::class,'index']); 

    Route::post('/Sesiones',[LecturasSessionController::class,'listar']); 
    Route::post('/Sesiones/add',[LecturasSessionController::class,'create']); 
    Route::put('/Sesiones',[LecturasSessionController::class,'update']); 
    Route::delete('/Sesiones',[LecturasSessionController::class,'eliminar']);   

    Route::get('/Palabras',[PalabrasController::class,'listar']); 

    Route::get('/TipoContenido',[TipoContenidoController::class,'index']); 
    Route::put('/Contenido',[LecturaContenidoController::class,'update']); 
    Route::put('/Contenido/Posicion',[LecturaContenidoController::class,'cambiarPosicion']); 
    Route::post('/Contenido',[LecturaContenidoController::class,'create']); 
    Route::post('/ContenidoFoto',[LecturaContenidoController::class,'foto']); 
    Route::delete('/Contenido',[LecturaContenidoController::class,'eliminar']);   
    Route::resource('/roles', RolesController::class);
    Route::get('/misPermisos', [RolesController::class, 'misPermiso']);
    Route::get('/user', [UsersController::class, 'listarP']);
    Route::post('/users/upload-image', [UsersController::class, 'uploadImage']);

    Route::get('/users/{id}', [updateUserController::class, 'listuser']);

    Route::patch('/updateusers/{id}', [updateUserController::class, 'updateuser']);

});
Route::get('/no', [LoginController::class, 'no'])->name('no');
Route::post('/login',[LoginController::class,'login'])->name('login');
Route::post('/user/nuevo',[LoginController::class,'registro']);
Route::get('/salir', [LoginController::class, 'salir']);
//traducir palabras
Route::post('/traducir', [traducirPalabrasController::class,'traducir']);

<?php

namespace App\Http\Controllers\User\perfil;

use App\Http\Controllers\Controller;
use App\Models\Datos;
use App\Models\User;
use Illuminate\Http\Request;

class perfilController extends Controller
{
    public function yo(Request $request, User $user)
    { 
        $datos = new Datos();  
        $user =  $request->user();
        if($user){ 
            $datos->id = 0;
            $datos->mensaje = "Informacion del Usuario";
            $datos->datos = [
                'nombre' => $user->name,
                'correo' => $user->email,
                'foto' => $user->image_path,
                'rol' => $user->elRol->nombre
            ];
        }
        else {
            $datos->id = -1;
            $datos->mensaje = "Usuario no Existe";
        }            
        return response()->json($datos);
    }
    
    
}

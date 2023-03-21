<?php

namespace App\Http\Controllers\User\updated;

use App\Http\Controllers\Controller;
use App\Models\Datos;
use App\Models\User;
use Illuminate\Http\Request;

class userUpdated extends Controller
{
    public function update(Request $request, User $user)
    {
        $permiso = false;
        $user = $request->user();
        if ($user->elRol->nombre === 'admin') {
            $permiso = true;
        } else
        if ($user->elPermiso->contains('nombre', 'editar_usuarios')) {
            $permiso = true;
        }
        $datos = new Datos();
        if ($permiso) {
            if (
                $request->has('id') && $request->has('nombre') && $request->has('correo')
                && $request->has('estado') && $request->has('rol')
            ) {
                $user = User::where('id', $request->id)->first();
                if($user){
                    $user->name = $request->nombre;
                    $user->email = $request->correo;
                    $user->r_users_roles = $request->rol;
                    $user->r_users_estados = $request->estado;
                    $user->save();
                    $datos->id = 0;
                    $datos->mensaje = "Editado el Usuario\n";
                }
                else {
                    $datos->id = -1;
                    $datos->mensaje = "Usuario no Existe\n";
                }
            } else {
                $datos->id = -1;
                $datos->mensaje = "Falta datos, para Editar el Usuario\n";
            }
        } else {
            $datos->id = -1;
            $datos->mensaje = "Sin Permiso, para Editar Usuario\n";
        }
        return response()->json($datos);
    }
    public function updateRol(Request $request, User $user)
    {
        $permiso = false;
        $user = $request->user();
        if ($user->elRol->nombre === 'admin') {
            $permiso = true;
        } else
        if ($user->elPermiso->contains('nombre', 'editar_usuarios')) {
            $permiso = true;
        }
        $datos = new Datos();
        if ($permiso) {
            if (
                $request->has('id') && $request->has('r_users_estados')
            ) {
                $user = User::where('id', $request->id)->first();
                if($user){ 
                    $user->r_users_estados = $request->r_users_estados;
                    $user->save();
                    $datos->id = 0;
                    $datos->mensaje = "Editado el rol del Usuario\n";
                }
                else {
                    $datos->id = -1;
                    $datos->mensaje = "Usuario no Existe\n";
                }
            } else {
                $datos->id = -1;
                $datos->mensaje = "Falta datos, para Editar el rol del Usuario\n";
            }
        } else {
            $datos->id = -1;
            $datos->mensaje = "Sin Permiso, para Editar el rol del Usuario\n";
        }
        return response()->json($datos);
    }
}

<?php

namespace App\Http\Controllers\Palabra\Editar;

use App\Http\Controllers\Controller;
use App\Models\Datos;
use App\Models\Palabras;
use Illuminate\Http\Request;

class EditarPalabra extends Controller
{
    public function EditarEstado(Request $request,Palabras $palabra){
        $datos = new Datos();
        if ($this->permiso($request)) {
            $palabra= Palabras::where('id',$request->id)->first();
            if($palabra){
                $palabra->estado=$request->a==0?'aprobado':'rechazado';
                $palabra->save();
                $datos->id = 0;
                $datos->mensaje = "Palabra Editada";
            }
            else{
                $datos->id = 1;
                $datos->mensaje = "Palabra no encontrada";
            }
            
        } else {
            $datos->id = -1;
            $datos->mensaje = "Sin Permiso para editar Estado de la Palabra";
        }
        return response()->json($datos);
    }
    private function permiso(Request $request)
    {
        $permiso = false;
        $user = $request->user();
        if ($user->elRol->nombre === 'admin') {
            $permiso = true;
        } else
        if ($user->elPermiso->contains('nombre', 'editar_palabra')) {
            $permiso = true;
        }
        return $permiso;
    }
}

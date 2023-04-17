<?php

namespace App\Http\Controllers;

use App\Models\Datos;
use App\Models\Permisos; 
use App\Models\RolesPermisoR;
use Illuminate\Http\Request;

class PermisosController extends Controller
{
    public function index(Request $req)
    {
        $datos = new Datos();
        if ($this->permiso($req,'ver_permiso')) {
            $permiso = Permisos::all(); 
            if ($permiso->count() > 0) {
                $datos->id = 0;
                $datos->mensaje = "Listado de Permiso";
                $datos->datos = $permiso;
                $datos->datos_len = $permiso->count();
            } else {
                $datos->id = 1;
                $datos->mensaje = "Sin Permios\n";
            }
        } else {
            $datos->id = -1;
            $datos->mensaje = "Sin Permiso para busqueda de Permisos";
        }
        return response()->json($datos);
    }
    public function store(Request $req)
    {
        $datos = new Datos();
        if ($this->permiso($req,'add_relacion')) {
            $existe=RolesPermisoR::where('fk_rol',$req->rol)->where('fk_permiso',$req->permiso)->first();
            if($existe){          
             $datos->mensaje = "Existente";
            }
            else{
             $rela= new RolesPermisoR();
             $rela->fk_rol=$req->rol;
             $rela->fk_permiso=$req->permiso;
             $rela->save(); 
             $datos->mensaje = "Guardado con exito";
            }
            $datos->id = 0;
        } else {
            $datos->id = -1;
            $datos->mensaje = "Sin Permiso para agregar esta relaccion";
        }
        return response()->json($datos);
    }
    public function eliminarRelacion(Request $req)
    {
        $datos = new Datos();
        if ($this->permiso($req,'eliminar_relacion')) {
            $existe=RolesPermisoR::where('fk_rol',$req->rol)->where('fk_permiso',$req->permiso)->first();
            if($existe){          
             $datos->mensaje = "Eliminado";
             $datos->id = 0;
             $existe->delete();
            }
            else{ 
             $datos->mensaje = "no existe";
             $datos->id = 1;
            }
        } else {
            $datos->id = -1;
            $datos->mensaje = "Sin Permiso para agregar esta relaccion";
        }
        return response()->json($datos);
    }

    private function permiso(Request $request,$cual)
    {
        $permiso = false;
        $user = $request->user();
        if ($user->elRol->nombre === 'admin') {
            $permiso = true;
        } else
        if ($user->elPermiso->contains('nombre', $cual)) {
            $permiso = true;
        }
        return $permiso;
    }

     
 
}

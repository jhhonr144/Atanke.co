<?php

namespace App\Http\Controllers;

use App\Models\Datos;
use App\Models\Lecturas;
use Illuminate\Http\Request;

class LecturasController extends Controller
{
    public function listar(Request $req)
    {
        $pagina = $req->has('pagina') ? $req->pagina : 1;
        $cantidad = $req->has('cantidad') ? $req->cantidad : 5;
        $dato = $req->has('dato') ? $req->dato : null;
        $query = Lecturas::withCount('sesiones as cantidad_sesiones')
            ->with('user:id,name')
            ->with('portada:id,multimedia')
            ->with('tipo:id,nombre');
        if ($dato) $query->where('nombre', 'like', "%$dato%");
        $lecturas = $query->paginate($cantidad, ['*'], 'pagina', $pagina);
        $datos = new Datos();
        try {
            $datos->id = $lecturas->lastPage();
            $datos->mensaje = "Listado de Lecturas #{$pagina}";
            $datos->datos = $lecturas->items();
            $datos->datos_len = $lecturas->total();
        } catch (\Exception $e) {
            $datos->id = -1;
            $datos->mensaje = "Error al listar Lecturas\n" . $e;
        }
        return response()->json($datos);
    }
    public function create(Request $request, Lecturas $lectura)
    {
        $permiso = false;
        $user = $request->user();
        if ($user->elRol->nombre === 'admin') {
            $permiso = true;
        } else
        if ($user->elPermiso->contains('nombre', 'crear_sesion')) {
            $permiso = true;
        }
        $datos = new Datos();
        if ($permiso) {
            if (
                $request->has('titulo') &&  $request->has('descripcion') && $request->has('categoria')
            ) {
                $lectura->nombre = $request->titulo;
                $lectura->descripcion = $request->descripcion;
                $lectura->fk_portada = $request->fk_portada == 0 ? 1 : $request->fk_portada;
                $lectura->fk_tipo = $request->categoria;
                $lectura->user_id = $user->id;
                $lectura->save();
            } else {
                $datos->id = -1;
                $datos->mensaje = "Falta datos, para agregar Lectura\n";
            }
        } else {
            $datos->id = -1;
            $datos->mensaje = "Sin Permiso, para agregar Lectura\n";
        }
        return response()->json($datos);
    }
    public function update(Request $request)
    {
        $permiso = false;
        $user = $request->user();
        if ($user->elRol->nombre === 'admin') {
            $permiso = true;
        } else
        if ($user->elPermiso->contains('nombre', 'editar_sesion')) {
            $permiso = true;
        }
        $datos = new Datos();
        if ($permiso) {
            if (
                $request->has('id') && $request->has('titulo') &&  $request->has('descripcion') && $request->has('categoria')
            ) {
                $lectura = Lecturas::where('id', $request->id)->first();
                $lectura->nombre = $request->titulo;
                $lectura->descripcion = $request->descripcion;
                $lectura->fk_portada = $request->fk_portada == 0 ? 1 : $request->fk_portada;
                $lectura->fk_tipo = $request->categoria;
                $lectura->user_id = $user->id;
                $lectura->save();
            } else {
                $datos->id = -1;
                $datos->mensaje = "Falta datos, para agregar Lectura\n";
            }
        } else {
            $datos->id = -1;
            $datos->mensaje = "Sin Permiso, para agregar Lectura\n";
        }
        return response()->json($datos);
    }
    public function delete(Request $request)
    {
        $permiso = false;
        $user = $request->user();
        if ($user->elRol->nombre === 'admin') {
            $permiso = true;
        } else
        if ($user->elPermiso->contains('nombre', 'eliminar_lectura')) {
            $permiso = true;
        }
        $datos = new Datos();
        if ($permiso) {
            $lectura = Lecturas::where('id', $request->id)->first();
            if ($lectura) {
                $lectura->sesiones()->delete();
                $lectura->delete();
                $datos->id = 0;
                $datos->mensaje = "Eliminada la lectura\n";
            } else {
                $datos->id = 1;
                $datos->mensaje = "Lectura no encontrado\n";
            }
        } else {
            $datos->id = -1;
            $datos->mensaje = "Sin Permiso, para Eliminar la lectura\n";
        }
        return response()->json($datos);
    }
}

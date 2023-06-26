<?php

namespace App\Http\Controllers\Palabra\Listar;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Datos;
use App\Models\Palabras;

class ListarPalabraPaginada extends Controller
{
    public function listar(Request $req)
    {
        $datos = new Datos();
        if ($this->permiso($req)) {
            //paginado
            $pagina = $req->has('pagina') ? $req->pagina : 1;
            $cantidad = $req->has('cantidad') ? $req->cantidad : 5;
            //palabra a coincidir
            $dato = $req->has('dato') ? $req->dato : null;
            //idioma all=todos
            $idioma = $req->has('idioma') ? $req->idioma : 0;
            $estado = $req->has('estado') ? $req->estado : 'aprobado';
            $query = Palabras::query();
            if ($estado == '')
                $estado = 'aprobado';
            if ($estado != 'all') {
                if (!in_array($estado, ['pendiente', 'aprobado', 'rechazado'])) {
                    $estado = 'aprobado';
                }
                $query->where('estado', $estado);
            }
            if ($dato != '') {
                $query->where(function ($query) use ($dato) {
                    $query->where('palabra', 'like', "%$dato%")
                        ->orWhere('pronunciar', 'like', "%$dato%");
                });
            }
            if ($idioma != 0) {
                $query->where('fk_idioma', $idioma);
            }
            $query->with('user:id,name,email')
                ->with('idioma')
                ->with('multimedia')
                ->withCount('multimedia as multilent');
            $query->orderBy('palabra', 'asc');
            $palabra = $query->paginate($cantidad, ['*'], 'pagina', $pagina);
            if ($palabra->count() > 0) {
                try {
                    $datos->id = $palabra->lastPage();
                    $datos->mensaje = "Listado de Palabra #{$pagina}";
                    $datos->datos = $palabra->items();
                    $datos->datos_len = $palabra->total();
                } catch (\Exception $e) {
                    $datos->id = -1;
                    $datos->mensaje = "Error al listar Palabra\n" . $e;
                }
            } else {
                $datos->id = -1;
                $datos->mensaje = "Sin Palabra";
            }
        } else {
            $datos->id = -1;
            $datos->mensaje = "Sin Permiso para busqueda avanzada de palabra\n";
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
        if ($user->elPermiso->contains('nombre', 'ver_palabra')) {
            $permiso = true;
        }
        return $permiso;
    }


    public function listarLibre(Request $req)
    {
        $datos = new Datos();
        //paginado
        $pagina = $req->has('pagina') ? $req->pagina : 1;
        $cantidad = $req->has('cantidad') ? $req->cantidad : 1000;
        $idioma = $req->has('idioma') ? $req->idioma : 0;
        
        $dato = $req->has('dato') ? $req->dato : null;
        $query = Palabras::query();
        if ($idioma != 0) {
            $query->where('fk_idioma', $idioma);
        }
        if ($dato != '') {
            $query->where(function ($query) use ($dato) {
                $query->where('palabra', 'like', "%$dato%")
                    ->orWhere('pronunciar', 'like', "%$dato%");
            });
        }
        $query->with([
            'multimedia' => function ($query) {
                $query->where('palabras_multimedia_r.estado', '=', 'aprobado');
            },
        ])->withCount([
            'multimedia as multilent' => function ($query) {
                $query->where('palabras_multimedia_r.estado', '=', 'aprobado');
            },
        ]);
        
        $query->where('estado', 'aprobado');
        
        $palabra = $query->paginate($cantidad, ['*'], 'pagina', $pagina);
        if ($palabra->count() > 0) {
            try {
                $datos->id = $palabra->lastPage();
                $datos->mensaje = "Listado de Palabra #{$pagina}";
                $datos->datos = $palabra->items();
                $datos->datos_len = $palabra->total();
            } catch (\Exception $e) {
                $datos->id = -1;
                $datos->mensaje = "Error al listar Palabra\n" . $e;
            }
        } else {
            $datos->id = -1;
            $datos->mensaje = "Sin Palabra\n".$dato;
        }

        return response()->json($datos);
    }
    public function listarde(Request $req)
    {
        $datos = new Datos();
        $palabra= Palabras::where('fk_user',$req->de)->orderBy('estado', 'desc')->get();
        try {
            $datos->id = 0;
            $datos->mensaje = "Listado de Palabra de user ".$req->de;
            $datos->datos = $palabra;
            $datos->datos_len =  $palabra->count();
        } catch (\Exception $e) {
            $datos->id = -1;
            $datos->mensaje = "Error al listar Palabra\n" . $e;
        }
        return response()->json($datos);
    }
}

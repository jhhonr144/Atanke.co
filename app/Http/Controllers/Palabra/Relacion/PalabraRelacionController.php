<?php

namespace App\Http\Controllers\Palabra\Relacion;

use App\Http\Controllers\Controller;
use App\Models\Datos;
use App\Models\Palabras_Palabras_r;
use Illuminate\Http\Request;

class PalabraRelacionController extends Controller
{
    public function listar(Request $req)
    {
        $datos = new Datos();
        if ($this->permiso($req, 'ver_palabras')) {
            //paginado
            $pagina = $req->has('pagina') ? $req->pagina : 1;
            $cantidad = $req->has('cantidad') ? $req->cantidad : 5;
            $estado = $req->has('estado') ? $req->estado : 'aprobado';
            $tipo = $req->has('tipo') ? $req->dato : 'Traducion';

            $dato = $req->has('dato') ? $req->dato : null;
            $idioma = $req->has('idioma') ? $req->idioma : null;
            $query = Palabras_Palabras_r::query();
            if ($estado == '')
                $estado = 'aprobado';
            if ($estado != 'all') {
                if (!in_array($estado, ['pendiente', 'aprobado', 'rechazado'])) {
                    $estado = 'aprobado';
                }
                $query->where('estado', $estado);
            }
            if ($tipo == '')
                $tipo = 'Traducion';
            if ($tipo != 'all') {
                if (!in_array($tipo, ['Traducion', 'Sinonimo', 'Antonimo'])) {
                    $tipo = 'Traducion';
                }
                $query->where('relacion', $tipo);
            }

            if ($dato != '' || $idioma!='' ) {
                if ($idioma == '')
                    $idioma == 0;
                $palabra = new Palabras_Palabras_r();
                $palabras = $palabra->buscarPalabra($dato, $idioma);
                if ($palabras)
                    $query->whereIn('id', $palabras->pluck('id'));
                else
                    $query->where('id', 0);
            }


            $query->with('user:id,name,email')
                ->with('palabra1.idioma')->with('palabra2.idioma')
                ->with('palabra1')->with('palabra2');
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
                $datos->mensaje = "Sin Palabra\n";
            }
        } else {
            $datos->id = -1;
            $datos->mensaje = "Sin Permiso para busqueda avanzada de palabra\n";
        }
        return response()->json($datos);
    }

    public function EditarEstado(Request $request)
    {
        $datos = new Datos();
        if ($this->permiso($request, 'editar_relacion')) {
            $palabra = Palabras_Palabras_r::where('id', $request->id)->first();
            if ($palabra) {
                $palabra->estado = $request->a == 0 ? 'aprobado' : 'rechazado';
                $palabra->save();
                $datos->id = 0;
                $datos->mensaje = "Palabra Editada\n";
            } else {
                $datos->id = 1;
                $datos->mensaje = "Palabra no encontrada\n";
            }
        } else {
            $datos->id = -1;
            $datos->mensaje = "Sin Permiso para editar Estado de la Palabra\n";
        }
        return response()->json($datos);
    }


    private function permiso(Request $request, $cual)
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

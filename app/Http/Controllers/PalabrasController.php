<?php

namespace App\Http\Controllers;

use App\Models\Datos;
use App\Models\Palabras;
use Illuminate\Http\Request;

class PalabrasController extends Controller
{
    public function listar(Request $req)
    {
        $pagina = $req->has('pagina') ? $req->pagina : 1;
        $cantidad = $req->has('cantidad') ? $req->cantidad : 5;
        $dato = $req->has('dato') ? $req->dato : null;
        $idioma = $req->has('idioma') ? $req->idioma : null;
        $query = Palabras::query();
        $query->with('multimedia')->withCount('multimedia as multilent');
        if ($idioma) {
            $query->where('fk_idioma', $idioma);
        }
        if ($dato) {
            $query->where(function ($q) use ($dato) {
                $q->where('palabra', 'like', "%$dato%")
                    ->orWhere('pronunciar', 'like', "%$dato%");
            });
        }
        $palabra = $query->paginate($cantidad, ['*'], 'pagina', $pagina);        
        $datos = new Datos();
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
            $datos->mensaje = "Sin Palabra\n" . $e;
        }
       
        return response()->json($datos);
    }
}

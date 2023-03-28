<?php

namespace App\Http\Controllers;

use App\Models\Datos;
use App\Models\LecturasTipo;
use App\Models\TipoLecturas;
use Illuminate\Http\Request;

class LecturasTipoController extends Controller
{
     
    public function index()
    {
        $categoria=LecturasTipo::select('id','nombre')->get();
        $datos = new Datos();
        try {
            $datos->id = 0;
            $datos->mensaje = "Listado de Categorias";
            $datos->datos = $categoria;
            $datos->datos_len = $categoria->count();
        } catch (\Exception $e) {
            $datos->id = -1;
            $datos->mensaje = "Error al listar Categorias\n" . $e;
        }
        return response()->json($datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
 
  
}

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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TipoLecturas  $tipoLecturas
     * @return \Illuminate\Http\Response
     */
    public function show(TipoLecturas $tipoLecturas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TipoLecturas  $tipoLecturas
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoLecturas $tipoLecturas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TipoLecturas  $tipoLecturas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoLecturas $tipoLecturas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TipoLecturas  $tipoLecturas
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoLecturas $tipoLecturas)
    {
        //
    }
}

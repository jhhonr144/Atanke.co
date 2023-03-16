<?php

namespace App\Http\Controllers;

use App\Models\Datos;
use App\Models\LecturasContenidoTipo;
use App\Models\TipoContenido;
use Illuminate\Http\Request;

class TipoContenidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tipos = LecturasContenidoTipo::all();
        $datos = new Datos(); 
        try {
            $datos->id = 0;
            $datos->mensaje = "lista de Tipo de contenido";
            $datos->datos = $tipos;
            $datos->datos_len = $tipos->count();
        } catch (\Exception $e) {
            $datos->id = -1;
            $datos->mensaje = "Error al lista Tipos contenidos\n" . $e;
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
     * @param  \App\Models\TipoContenido  $tipoContenido
     * @return \Illuminate\Http\Response
     */
    public function show(TipoContenido $tipoContenido)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TipoContenido  $tipoContenido
     * @return \Illuminate\Http\Response
     */
    public function edit(TipoContenido $tipoContenido)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TipoContenido  $tipoContenido
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TipoContenido $tipoContenido)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TipoContenido  $tipoContenido
     * @return \Illuminate\Http\Response
     */
    public function destroy(TipoContenido $tipoContenido)
    {
        //
    }
}

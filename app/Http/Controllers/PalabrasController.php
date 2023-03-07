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
        if ($idioma) $query->where('fk_idioma', $idioma);
        if ($dato) $query->where('palabra', 'like', "%$dato%")
        ->orWhere('pronunciar', 'like', "%$dato%");
        $palabra = $query->with('multimedia(1)')->paginate($cantidad, ['*'], 'pagina', $pagina);
        $datos = new Datos();
        try {
            $datos->id = $palabra->lastPage();
            $datos->mensaje = "Listado de Palabra #{$pagina}";
            $datos->datos = $palabra->items();
            $datos->datos_len = $palabra->total();
        } catch (\Exception $e) {
            $datos->id = -1;
            $datos->mensaje = "Error al listar Palabra\n" . $e;
        }
        return response()->json($datos);
    }
    public function index()
    {
        //
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
     * @param  \App\Models\Palabras  $palabras
     * @return \Illuminate\Http\Response
     */
    public function show(Palabras $palabras)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Palabras  $palabras
     * @return \Illuminate\Http\Response
     */
    public function edit(Palabras $palabras)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Palabras  $palabras
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Palabras $palabras)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Palabras  $palabras
     * @return \Illuminate\Http\Response
     */
    public function destroy(Palabras $palabras)
    {
        //
    }
}

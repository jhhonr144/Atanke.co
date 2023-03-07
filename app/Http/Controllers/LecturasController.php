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
        ->with('tipo:id,nombre')
            ;
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
     * @param  \App\Models\Lecturas  $lecturas
     * @return \Illuminate\Http\Response
     */
    public function show(Lecturas $lecturas)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lecturas  $lecturas
     * @return \Illuminate\Http\Response
     */
    public function edit(Lecturas $lecturas)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lecturas  $lecturas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lecturas $lecturas)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lecturas  $lecturas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lecturas $lecturas)
    {
        //
    }
}

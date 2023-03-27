<?php

namespace App\Http\Controllers\Palabra\Idiomas;

use App\Http\Controllers\Controller;
use App\Models\Datos;
use App\Models\Idiomas;
use Illuminate\Http\Request;

class listarIdiomas extends Controller
{
    public function listar()
    {
        $idiomas=Idiomas::all();
        $datos=new Datos();
        $datos->id = 0;
        $datos->mensaje = "Listado de Idiomas";
        $datos->datos = $idiomas;
        $datos->datos_len = $idiomas->count();
        return response()->json($datos);
    }
}

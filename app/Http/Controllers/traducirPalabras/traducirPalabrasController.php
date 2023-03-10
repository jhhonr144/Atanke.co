<?php

namespace App\Http\Controllers\traducirPalabras;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BaseController;

class traducirPalabrasController extends BaseController
{
    public function traducir(Request $request)
    {

        if (!$request->filled('data')) {
            $response = [
                'dataHeader' => $this->ResponseOk(-1, ['Parámetros requeridos.'])
            ];

            return response()->json($response, 400);
        }

        $palabras = explode(' ', $request->input('data'));
        $traducciones = [];

        foreach ($palabras as $palabra) {
            $palabra = trim($palabra);

            if (empty($palabra)) {
                $traducciones[] = $palabra;
                continue;
            }

            $traduccion = DB::table('palabras_palabras_r')
                ->leftJoin('palabras', 'palabras_palabras_r.palabra_id_1', '=', 'palabras.id')
                ->leftJoin('palabras AS p2', 'palabras_palabras_r.palabra_id_2', '=', 'p2.id')
                ->where('palabras.palabra', $palabra)
                ->select('p2.palabra')
                ->get()
                ->first();

            if ($traduccion) {
                $traducciones[] = $traduccion->palabra;
            } else {
                $traducciones[] = "<$palabra>";
            }
        }

        $response = [
            'dataHeader' => $this->ResponseOk(0, []),
            'traduccion' => implode(' ', $traducciones)
        ];

        return response()->json($response);
    }
}

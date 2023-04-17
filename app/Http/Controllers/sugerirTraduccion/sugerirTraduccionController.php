<?php

namespace App\Http\Controllers\sugerirTraduccion;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\BaseController;

class sugerirTraduccionController extends BaseController
{

    public function sugerirTraduccion(Request $request)
    {
        $input = $request->all();

        if (!isset($input['codIdioma'], $input['palabra'], $input['traduccion'])) {
            $response = [
                'dataHeader' => $this->ResponseOk(-1, ['Parámetros requeridos.'])
            ];
            return response()->json($response, 400);
        }
        $palabra = DB::table('palabras')->where('palabra', $input['palabra'])->first();
        $traduccion = DB::table('palabras')->where('palabra', $input['traduccion'])->first();

        $palabra_id = $palabra ? $palabra->id : DB::table('palabras')->insertGetId([
            'palabra' => $input['palabra'],
            'estado' => 'I',
            'pronunciar' => $input['pronunciacion'],
            'fk_user' => $input['fkUser'],
            'fk_idioma' => $input['codIdioma'],
        ]);

        $traduccion_id = $traduccion ? $traduccion->id : DB::table('palabras')->insertGetId([
            'palabra' => $input['traduccion'],
            'estado' => 'I',
            'pronunciar' => '',
            'fk_user' => $input['fkUser'],
            'fk_idioma' => $input['codIdioma2']
        ]);

        // Verificar si ya existe la relación en la tabla palabras_palabras_r
        $existente = DB::table('palabras_palabras_r')
            ->where('palabra_id_1', $palabra_id)
            ->where('palabra_id_2', $traduccion_id)
            ->first();

        // Si la relación no existe, agregarla
        if (!$existente) {
            DB::table('palabras_palabras_r')->insert([
                'palabra_id_1' => $palabra_id,
                'palabra_id_2' => $traduccion_id,
                'relacion' => 'Traducion',
                'fk_user' => $input['fkUser'],

                'estado' => 'I'
            ]);

            DB::table('palabras_palabras_r')->insert([
                'palabra_id_1' => $traduccion_id,
                'palabra_id_2' => $palabra_id,
                'relacion' => 'Traducion',
                'fk_user' => $input['fkUser'],
                'estado' => 'I'
            ]);

            $response = [
                'dataHeader' => $this->ResponseOk(0, []),
                'mensaje' => 'Traducción sugerida correctamente.'
            ];

            return response()->json($response);
        } else {
            $response = [
                'dataHeader' => $this->ResponseOk(2, []),
                'mensaje' => 'Ya existe una traduccion para estas palabras'
            ];

            return response()->json($response);
        }
    }
}

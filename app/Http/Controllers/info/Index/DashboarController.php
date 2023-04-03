<?php

namespace App\Http\Controllers\info\Index;

use App\Http\Controllers\Controller;
use App\Models\Datos;
use App\Models\Palabras;
use App\Models\Palabras_Palabras_r;
use App\Models\User;

class DashboarController extends Controller
{
    public function contadores()
    {
        $datos = new Datos();
        $datos->id = 0;
        $datos->datos = [
            'palabras' => [
                'aprobado' => Palabras::where('estado', 'aprobado')->count(),
                'rechazado' => Palabras::where('estado', 'rechazado')->count(),
                'pendiente' => Palabras::where('estado', 'pendiente')->count(),
                't' => Palabras::count(),
            ],
            'usuarios' => [
                'activos' => User::where('r_users_estados', 1)->count(),
                'inactivo' => User::where('r_users_estados', 2)->count(),
                'validados' => User::whereNotNull('email_verified_at')->count(), 
            ],
            'relaciones' => [
                'aprobado' => Palabras_Palabras_r::where('estado', 'aprobado')->count(),
                'rechazado' => Palabras_Palabras_r::where('estado', 'rechazado')->count(),
                'pendiente' => Palabras_Palabras_r::where('estado', 'pendiente')->count(),
                't' => Palabras_Palabras_r::count(),
            ]
        ];
        return response()->json($datos);
    }
}

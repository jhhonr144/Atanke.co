<?php

namespace App\Http\Controllers\User\Login;

use App\Http\Controllers\Controller;
use App\Models\Datos;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogearController extends Controller
{
    public function login(Request $request)
    {
        $datos = new Datos();
        try {
            if (!Auth::attempt($request->only('email', 'password'))) {
                $datos->id = 1;
                $datos->mensaje = "Error al logearse.";
                $datos->datos = null;
                return response()->json($datos);
            }
            $user = User::where('email', $request->email)->firstOrFail();
            $token = $user->CreateToken('auth_token')->plainTextToken;
            if($user->elEstado->nombre=='activo'){
                $user->remember_token=$token;
                $user->save();
                $datos->id = 0;
                $datos->mensaje = $token;
                $datos->datos = $user;
                $datos->datos_len = $user->id;
            }
            else{
                $datos->id = 1;
                $datos->mensaje = "usuario Inactivo"; 
            }
        } catch (\Exception $e) {
            $datos->id = 1;
            $datos->mensaje = "Error Logear user\n" . $e;
            $datos->datos = null;
        }
        return response()->json($datos);
    }
}

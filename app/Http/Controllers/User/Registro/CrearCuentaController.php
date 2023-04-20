<?php

namespace App\Http\Controllers\User\Registro;

use App\Http\Controllers\Controller;
use App\Models\Datos;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class CrearCuentaController extends Controller
{
    public function registro(Request $request)
    {
        $datos = new Datos();
        try {
            $validar = Validator::make(
                $request->all(),
                [
                    'name' => 'required|string|max:225',
                    'email' => 'required|string|email|max:225|unique:users',
                    'password' => 'required|string|min:6',
                ]
            );
            if ($validar->fails()) {
                $datos->id = -1;
                $datos->mensaje = "Error por datos erroneos"; 
                $datos->datos = null;          
                $datos->errores = $validar->errors();
                
            } else {
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' =>  Hash::make($request->password),
                    'r_users_roles' => 1,
                    'r_users_estados' => 1
                ]);
                $token = $user->CreateToken('auth_token')->plainTextToken;
                $datos->id = 0;
                $datos->mensaje = $token;
                $datos->datos = $user;
                $datos->datos_len = $user->id;
            }
        } catch (\Exception $e) {
            $datos->id = -1;
            $datos->mensaje = "Error crear user\n" . $e;
        }
        return response()->json($datos);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Datos;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\Sanctum;

class LoginController extends Controller
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
                return response()->json($validar->errors());
            }
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
        } catch (\Exception $e) {
            $datos->id = 1;
            $datos->mensaje = "Error crear user\n" . $e;
        }
        return response()->json($datos);
    }
    public function login(Request $request)
    {
        $datos = new Datos();
        try {
            if (!Auth::attempt($request->only('email', 'password'))) {
                $datos->id = 1;
                $datos->mensaje = "Error al logearse";
                return response()->json($datos, 401);
            }
            $user = User::where('email', $request->email)->firstOrFail();
            $token = $user->CreateToken('auth_token')->plainTextToken;
            $datos->id = 0;
            $datos->mensaje = $token;
            $datos->datos = $user;
            $datos->datos_len = $user->id;
        } catch (\Exception $e) {
            $datos->id = 1;
            $datos->mensaje = "Error crear user\n" . $e;
        }
        return response()->json($datos);
    }
    public function salir()
    {
        try {
            $userTokens = auth()->user()->tokens;
            foreach ($userTokens as $token) {
                $token->revoke();
            }
        } catch (\Exception $e) {
            return response()->json([$e], 403);
        }

        $datos = new Datos();
        $datos->id = 0;
        $datos->mensaje = "Salido";
        return response()->json($datos);
    }
}

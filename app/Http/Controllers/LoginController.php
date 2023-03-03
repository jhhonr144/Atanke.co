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
            $user->remember_token=$token;
            $user->save();
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
    public function salir(Request $request)
    {
        $user = $request->user('sanctum');
        if (!$user) {
            return response()->json(['error' => 'No autenticado'], 401);
        }
        $user->tokens()->delete();
        
        $datos = new Datos();
        $datos->id = 0;
        $datos->mensaje = "Salido";
        return response()->json($datos);
    }
    public function ok(Request $request)
    {
        $user = $request->user();
        if (!$user) {
            return response()->json(['error' => 'No autenticado'], 401);
        }
        return response()->json('ok');
    }
    public function no()
    {
        return response()->json('no', 401);
    }
}


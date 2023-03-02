<?php

namespace App\Http\Controllers;

use App\Models\Datos;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Sanctum\Sanctum;



use Illuminate\Support\Facades\Storage;

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
                $datos->mensaje = "Error al logearse.";
                return response()->json($datos);
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

/* 
    public function uploadImage(Request $request)
    {
        $user = auth()->user();

        // Verifica si el usuario ha subido una imagen

        // Obtener el usuario autenticado
        $user = $request->user();

        // Verificar si se envió un archivo de imagen
        if ($request->hasFile('image')) {
            // Obtener el archivo de imagen cargado
            $image = $request->file('image');

            // Generar un nombre único para el archivo
            $filename = uniqid() . '.' . $image->getClientOriginalExtension();

            // Guardar la imagen en el sistema de archivos
            Storage::disk('public')->put('images', $image, $filename);

            // Actualizar el campo "image_path" del usuario
            $user->image_path = $filename;
            $user->save();

            // Retornar una respuesta JSON con la ruta de la imagen
            return response()->json(['image_path' => $filename]);
        } else {
            // Retornar una respuesta de error si no se envió un archivo
            return response()->json(['error' => 'No se envió un archivo de imagen'], 400);
        }
    } */
}

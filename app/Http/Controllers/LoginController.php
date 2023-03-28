<?php

namespace App\Http\Controllers;

use App\Models\Datos;
use Illuminate\Http\Request;

class LoginController extends Controller
{   
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

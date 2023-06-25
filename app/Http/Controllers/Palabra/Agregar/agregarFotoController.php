<?php

namespace App\Http\Controllers\Palabra\Agregar;

use App\Http\Controllers\Controller;
use App\Models\Datos;
use App\Models\Multimedias; 
use App\Models\Palabras_Multimedia_r;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class agregarFotoController extends Controller
{ 
    public function foto(Request $request)
    {
        $permiso = false;
        $datos = new Datos(); 
        $user = $request->user();
        if($user){
            $datos->id=1;
            $datos->mensaje="No tienes permiso para subir archivos";
            if ($user->elRol->nombre === 'admin') {
                $permiso = true;
            } else
            if ($user->elPermiso->contains('nombre', 'crear_multimedia')) {
                $permiso = true;
            }
            if ($user->elPermiso->contains('nombre', 'block_multimedia')) {
                $permiso = !true;
                $datos->id=1;
                $datos->mensaje="Su permiso para subir archivos, Fue bloqueado";
            }
            if ($permiso ){  
                $imageName = $user->id . '_Palabra_' . time() . '.png'; 
                $base=str_replace(['-', '_'], ['+', '/'], $request->contenido);
                $imgdecode=base64_decode($base);
                Storage::disk('public')->put('img/Contenido/' . $imageName,($imgdecode), 'public');
                $datos->id = 0;
                $datos->mensaje =$imageName;
                //aqui le agragamos la imagen a la palabra
                $rela= new Palabras_Multimedia_r();
                $multi= new Multimedias();
                $multi->descripcion=$request->nombre;
                $multi->multimedia=$datos->mensaje;
                $multi->fk_user=$user->id;
                $multi->fk_tm=1;
                $multi->save();
                $rela->fk_palabra=$request->id;
                $rela->fk_multimedia=$multi->id;  
                $rela->save();
            } 
        }
        else{ 
            $datos->id=1;
            $datos->mensaje="No encontramos tus credenciales";
        }
        return response()->json($datos);
    }
}

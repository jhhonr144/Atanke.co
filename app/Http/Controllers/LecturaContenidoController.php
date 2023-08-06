<?php

namespace App\Http\Controllers;

use App\Models\Datos;
use App\Models\LecturasContenido;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class LecturaContenidoController extends Controller
{ 
    public function update(Request $request, LecturasContenido $contenidoLectura)
    {
        $permiso = false;
        $user = $request->user();
        if ($user->elRol->nombre === 'admin') {
            $permiso = true;
        } else
        if ($user->elPermiso->contains('nombre', 'editar_contenido')) {
            $permiso = true;
        }
        $datos = new Datos();
        if ($permiso) {
            if (isset($request->id)) {
                $contenidoLectura = LecturasContenido::where('id', $request->id)->first();
                if (isset($request->contenido))
                    $contenidoLectura->contenido = $request->contenido;
                if (isset($request->tipo))
                    $contenidoLectura->fk_tipo = $request->tipo;
                if (isset($request->posicion))
                    $contenidoLectura->posicion = $request->posicion;
                $contenidoLectura->save();
                $contenidos = LecturasContenido::where('fk_sesion', $contenidoLectura->fk_sesion)
                    ->with('tipoContenido:id,nombre')
                    ->orderBy('posicion')
                    ->orderBy('updated_at', 'desc')
                    ->get();
                $datos->id = 0;
                $datos->datos = $contenidos;
                $datos->datos_len = $contenidos->count();
                $datos->mensaje = "Actualizado el contenido\n";
            } else {
                $datos->id = -1;
                $datos->mensaje = "Sin Datos, para Actualizar el Contenido\n";
            }
        } else {
            $datos->id = -1;
            $datos->mensaje = "Sin Permiso, para Actualizar el Contenido\n";
        }
        return response()->json($datos);
    }
    public function create(Request $request)
    {
        $permiso = false;
        $user = $request->user();
        if ($user->elRol->nombre === 'admin') {
            $permiso = true;
        } else
        if ($user->elPermiso->contains('nombre', 'crear_contenido')) {
            $permiso = true;
        }
        $datos = new Datos();
        if ($permiso) {
            $lectura =  LecturasContenido::where('fk_sesion',$request->fk_sesion)->orderBy('posicion', 'desc')->first();
            if(!$lectura){
                $lectura = new LecturasContenido();
                $lectura->posicion=0;
                $lectura->fk_sesion=$request->fk_sesion;
            }
            $contenidoLectura = new LecturasContenido();
            if (isset($request->contenido))
                $contenidoLectura->contenido = $request->contenido;
            if (isset($request->tipo))
                $contenidoLectura->fk_tipo = $request->tipo;
            $contenidoLectura->posicion = $lectura->posicion + 1;
            $contenidoLectura->fk_sesion = $lectura->fk_sesion;
            $contenidoLectura->save();
            $contenidos = LecturasContenido::where('fk_sesion', $contenidoLectura->fk_sesion)
                ->with('tipoContenido:id,nombre')
                ->orderBy('posicion')
                ->orderBy('updated_at', 'desc')->get();
            $datos->id = 0;
            $datos->datos = $contenidos;
            $datos->datos_len = $contenidos->count();
            $datos->mensaje = "Agregado el contenido\n";
        } else {
            $datos->id = -1;
            $datos->mensaje = "Sin Permiso, para Crear el Contenido\n";
        }
        return response()->json($datos);
    }
    public function foto(Request $request)
    {
        $permiso = false;
        $user = $request->user();
        if ($user->elRol->nombre === 'admin') {
            $permiso = true;
        } else
        if ($user->elPermiso->contains('nombre', 'crear_contenido')) {
            $permiso = true;
        }
        $datos = new Datos();
        if ($permiso) {
            if ($request->uno == '1')
                $validator = Validator::make($request->all(), [
                    'contenido' => 'file|mimetypes:video/avi,video/mp4,image/jpeg,image/png,image/jpg|max:20480',
                ]);
            else 
                $validator = Validator::make($request->all(), [
                    'contenido.*' => 'file|mimetypes:video/avi,video/mp4,image/jpeg,image/png,image/jpg|max:20480',
                ]);
            if ($validator->fails()) {
                $datos->id = -1;
                $datos->mensaje = "Error al Guardar Contenido, para Crear el Contenido\n";
                return response()->json($datos);
            } else {
                $imageName = "";
                if ($request->uno == '1') {
                    $image = $request->file('contenido');
                    $imageName = $user->id . '_' . time() . '.' . $image->getClientOriginalExtension();
                    //$image->storeAs('public/img/Contenido', $imageName, ['visibility' => 'public']);                     
                    $image->storeAs('Back/storage/img/Contenido', $imageName, ['visibility' => 'public']);   
                    $imageName .= ',';
                } else {
                    foreach ($request->file('contenido') as $index => $file) {
                        $imageNam = $user->id . '_' . time() . '_' . $index . '.' . $file->getClientOriginalExtension();
                       // $file->storeAs('public/img/Contenido', $imageNam, ['visibility' => 'public']);                
                        $file->storeAs('Back/storage/img/Contenido', $imageName, ['visibility' => 'public']); 
                        $imageName .= $imageNam . ',';
                    }
                }
                $datos->id = 0;
                $datos->mensaje = substr($imageName, 0, -1);
            }
        }
        return response()->json($datos);
    }
    public function eliminar(Request $request)
    {
        $permiso = false;
        $user = $request->user();
        if ($user->elRol->nombre === 'admin') {
            $permiso = true;
        } else
        if ($user->elPermiso->contains('nombre', 'eliminar_contenido')) {
            $permiso = true;
        }
        $datos = new Datos();
        if ($permiso) {
            $lectura =  LecturasContenido::where('id', $request->id)->first();
            if ($lectura) {
                $datos->mensaje = "Eliminado el contenido\n";
                $this->eliminarPosicionesVacias($lectura->fk_sesion);
                $lectura->delete();
                $contenidos = LecturasContenido::where('fk_sesion', $lectura->fk_sesion)
                    ->with('tipoContenido:id,nombre')
                    ->orderBy('posicion')
                    ->orderBy('updated_at', 'desc')->get();
                $datos->id = 0;
                $datos->datos = $contenidos;
                $datos->datos_len = $contenidos->count();
                $datos->mensaje = "Eliminado el contenido\n";                
            } else {
                $datos->id = 1;
                $datos->mensaje = "Contenido no encontrado\n";
            }
        } else {
            $datos->id = -1;
            $datos->mensaje = "Sin Permiso, para Eliminar el Contenido\n";
        }
        return response()->json($datos);
    }
    public function cambiarPosicion(Request $request)
    {
        $permiso = false;
        $user = $request->user();
        if ($user->elRol->nombre === 'admin') {
            $permiso = true;
        } else
        if ($user->elPermiso->contains('nombre', 'editar_contenido')) {
            $permiso = true;
        }
        $datos = new Datos();
        if ($permiso) {
            $contenidoLectura = LecturasContenido::where('id', $request->id)->first();
            if ($contenidoLectura) {
                $posicionActual = $contenidoLectura->posicion;
                if ($request->funcion == '--' && $posicionActual != 1) {
                    $datos->mensaje = "Modificado el contenido \nSe coloco de primero";
                    for ($i = $posicionActual - 1; $i >= 1; $i--) {
                        $elemento = LecturasContenido::where('fk_sesion', $contenidoLectura->fk_sesion)
                            ->where('posicion', $i)->first();
                        if ($elemento) {
                            $elemento->posicion++;
                            $elemento->save();
                        }
                    }
                    $contenidoLectura->posicion = 1;
                    $contenidoLectura->save();
                }
                if ($request->funcion == '-' && $posicionActual != 1) {
                    $datos->mensaje = "Modificado el contenido \nSe bajo una posición";
                    $elemento = LecturasContenido::where('fk_sesion', $contenidoLectura->fk_sesion)
                        ->where('posicion', '<', $contenidoLectura->posicion)
                        ->orderBy('posicion', 'desc')
                        ->first();
                    if ($elemento) {
                        $contenidoLectura->posicion = $elemento->posicion;
                        $elemento->posicion++;
                        $elemento->save();
                        $contenidoLectura->save();
                    }
                }
                if ($request->funcion == '+') {
                    $datos->mensaje = "Modificado el contenido \nSe subio una Posición";
                    $elemento = LecturasContenido::where('fk_sesion', $contenidoLectura->fk_sesion)
                        ->where('posicion', '>', $contenidoLectura->posicion)
                        ->orderBy('posicion', 'asc')
                        ->first();
                    if ($elemento) {
                        $contenidoLectura->posicion = $elemento->posicion;
                        $elemento->posicion--;
                        $elemento->save();
                        $contenidoLectura->save();
                    }
                }
                if ($request->funcion == '++') {
                    $datos->mensaje = "Modificado el contenido \nSe puso de ultimo";
                    $maxPosicion = LecturasContenido::where('fk_sesion', $contenidoLectura->fk_sesion)->max('posicion');
                    $contenidoLectura->posicion = $maxPosicion + 1;
                    $contenidoLectura->save();
                    $this->eliminarPosicionesVacias($contenidoLectura->fk_sesion);
                }
                $contenidos = LecturasContenido::where('fk_sesion', $contenidoLectura->fk_sesion)
                    ->with('tipoContenido:id,nombre')
                    ->orderBy('posicion')
                    ->orderBy('updated_at', 'desc')->get();
                $datos->id = 0;
                $datos->datos = $contenidos;
                $datos->datos_len = $contenidos->count();
            } else {
                $datos->id = -1;
                $datos->mensaje = "Contenido no existe";
            }
        } else {
            $datos->id = -1;
            $datos->mensaje = "Sin Permiso, para Actualizar el Contenido\n";
        }
        return response()->json($datos);
    }
    private function eliminarPosicionesVacias($fk_sesion)
    { 
        $elementos = LecturasContenido::where('fk_sesion', $fk_sesion)
            ->orderBy('posicion', 'asc')
            ->get();
        $key = 1;
        foreach ($elementos as  $elemento) {
            $elemento->posicion = $key++;
            $elemento->save();
        }
    }
}

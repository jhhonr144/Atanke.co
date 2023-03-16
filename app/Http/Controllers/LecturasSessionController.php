<?php

namespace App\Http\Controllers;

use App\Models\Datos;
use App\Models\LecturasSession;
use Illuminate\Http\Request;

class LecturasSessionController extends Controller
{
    public function Listar(Request $request)
    {
        $sesion = $this->lista($request->fk_lectura);
        $datos = new Datos();
        if (!$sesion) {
            $datos->id = -1;
            $datos->mensaje = "Sin Datos Sesiones\n";
        } else
            try {
                $datos->id = 0;
                $datos->mensaje = !isset($sesion[0]->lectura) ? null : $sesion[0]->lectura->nombre;
                $datos->datos = $sesion;
                $datos->datos_len = $sesion->count();
            } catch (\Exception $e) {
                $datos->id = -1;
                $datos->mensaje = "Error al lista Sesiones\n" . $e;
            }
        return response()->json($datos);
    }
    public function update(Request $request, LecturasSession $LecturaSession)
    {
        $permiso = false;
        $user = $request->user();
        if ($user->elRol->nombre === 'admin') {
            $permiso = true;
        } else
        if ($user->elPermiso->contains('nombre', 'editar_sesion')) {
            $permiso = true;
        }
        $datos = new Datos();
        if ($permiso) {
            if (isset($request->lectura)) {
                $sesion = LecturasSession::where('id', $request->lectura)->first();
                $sesion->nombre = $request->nombre;
                $sesion->save();
                $sesion = $this->lista($sesion->fk_lectura);
                if (!$sesion) {
                    $datos->id = -1;
                    $datos->mensaje = "Editado,Sin Datos Sesiones\n";
                } else {
                    $datos->id = 0;
                    $datos->mensaje = !isset($sesion[0]->lectura) ? null : $sesion[0]->lectura->nombre;
                    $datos->datos = $sesion;
                    $datos->datos_len = $sesion->count();
                }
            } else {
                $datos->id = -1;
                $datos->mensaje = "debe enviar el id, para Actualizar la Sesión\n";
            }
        } else {
            $datos->id = -1;
            $datos->mensaje = "Sin Permiso, para Actualizar la Sesión\n";
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
        if ($user->elPermiso->contains('nombre', 'crear_sesion')) {
            $permiso = true;
        }
        $datos = new Datos();
        if ($permiso) { 
                $id=1+ LecturasSession::where('fk_lectura', $request->fk_lectura)->max('posicion');
                $sesion = new LecturasSession();
                $sesion->nombre = $request->nombre;
                $sesion->posicion = $id;
                $sesion->fk_lectura= $request->fk_lectura;
                $sesion->save();
                
                $sesion = $this->lista($sesion->fk_lectura);
                if (!$sesion) {
                    $datos->id = -1;
                    $datos->mensaje = "Editado,Sin Datos Sesiones\n";
                } else {
                    $datos->id = 0;
                    $datos->mensaje = !isset($sesion[0]->lectura) ? null : $sesion[0]->lectura->nombre;
                    $datos->datos = $sesion;
                    $datos->datos_len = $sesion->count();
                } 
        } else {
            $datos->id = -1;
            $datos->mensaje = "Sin Permiso, para Actualizar la Sesión\n";
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
        if ($user->elPermiso->contains('nombre', 'eliminar_sesion')) {
            $permiso = true;
        }
        $datos = new Datos();
        if ($permiso) {
            $sesion= LecturasSession::where('id',$request->id)->first(); 
            if ($sesion) {
                $datos->mensaje = "Eliminado la Sesion\n"; 
                $sesion->contenidoLecturas()->delete(); 
                $sesion->delete(); 
                $this->eliminarPosicionesVacias($sesion->fk_lectura);
                $sesion = $this->lista($sesion->fk_lectura);
                if (!$sesion) {
                    $datos->id = -1;
                    $datos->mensaje = "Sin Datos Sesiones\n";
                } else {
                    $datos->id = 0;
                    $datos->mensaje = !isset($sesion[0]->lectura) ? null : $sesion[0]->lectura->nombre;
                    $datos->datos = $sesion;
                    $datos->datos_len = $sesion->count();
                }                
            } else {
                $datos->id = 1;
                $datos->mensaje = "Sesión no encontrado\n";
            }
        } else {
            $datos->id = -1;
            $datos->mensaje = "Sin Permiso, para Eliminar la Sesión\n";
        }
        return response()->json($datos);
    }
    private function Lista($idLectura)
    {
        return LecturasSession::where('fk_lectura', $idLectura)
            ->with('contenidoLecturas')
            ->with('contenidoLecturas.tipoContenido:id,nombre')
            ->withCount('contenidoLecturas as contenidos')
            ->orderBy('posicion')
            ->with(['contenidoLecturas' => function ($query) {
                $query->orderBy('posicion')->orderBy('updated_at', 'desc');
            }])
            ->get();
    }
    private function eliminarPosicionesVacias($id)
    { 
        $sesion=LecturasSession::where('fk_lectura',$id)->get(); 
        $sl=1;
        foreach($sesion as $s){
            $s->posicion=$sl;
            $sl+=1;
            $s->save();
        }
    }
}

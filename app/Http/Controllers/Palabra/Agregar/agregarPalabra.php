<?php

namespace App\Http\Controllers\Palabra\Agregar;

use App\Http\Controllers\Controller;
use App\Models\Datos;
use App\Models\Palabras;
use App\Models\Permisos;
use Illuminate\Http\Request;

class agregarPalabra extends Controller
{
    private $permisos;
    private $user;
    public function AgregarPalabra(Request $req, Palabras $palabra)
    {
        $this->permisos = $req->user()->permisos->pluck('nombre')->toArray();
        $datos = new Datos();
        if ($this->permiso($req, 'crear_palabra')) {
            if ($this->permiso($req, 'block_palabra', false)) {
                $datos->id = -1;
                $datos->mensaje = "Lo sentimos, un Admin te ha bloqueado esta opción.";
            } else {
                if (!$this->permiso($req, 'crear_palabra')) {
                    $datos->id = -1;
                    $datos->mensaje = "Lo sentimos, no tienes permiso para crea palabras.";
                    $datos->datos = $this->permisos;
                } else {
                    if (!$req->has('palabra') || !$req->has('fk_idioma')) {
                        $datos->id = 1;
                        $datos->mensaje = "Lo sentimos, Faltaron datos para poder crear la palabra.";
                    } else {
                        $pala = Palabras::where("palabra", $req->palabra)->first();
                        if (!$pala) {
                            $palabra->palabra = $req->palabra;
                            $palabra->fk_idioma = $req->fk_idioma;
                            $palabra->fk_user = $this->user->id;
                            if ($req->has('pronunciar'))
                                $palabra->pronunciar = $req->pronunciar . "";
                            else
                                $palabra->pronunciar = '';
                            if ($this->permiso($req, 'admin'))
                                $palabra->estado = 'Aprobado';
                            $palabra->save();                            
                            $datos->mensaje = "Agrego palabra.";
                        }
                        else
                        $datos->mensaje = "palabra repetida.";
                        $datos->id = 0;
                        $datos->datos_len = $palabra->id;
                        $datos->datos = $palabra;
                    }
                }
            }
        } else {
            $datos->id = -1;
            $datos->mensaje = "Usuario No Encontrado.";
        }
        return response()->json($datos);
    }
    private function permiso(Request $request, $PermisoBuscado, $admin = true)
    {
        $permiso = false;
        $this->user = $request->user();
        if ($this->user->elRol->nombre === 'admin' & $admin) {
            $permiso = true;
        } else        
        if (in_array($PermisoBuscado, $this->permisos)) {
            $permiso = true;
        }
        return $permiso;
    }
}

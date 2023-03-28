<?php

namespace App\Http\Controllers;

use App\Models\Datos;
use App\Models\Permisos;
use App\Models\Roles; 
use Illuminate\Http\Request; 

class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Roles::all();
        $datos= new Datos();
        try{
            $datos->id=0;
            $datos->mensaje="Listado de Roles";
            $datos->datos=$roles;
            $datos->datos_len=$roles->count();
        } 
        catch (\Exception $e) { 
            $datos->id=1;
            $datos->mensaje="Error al listar Roles\n".$e; 
        }
        return response()->json($datos);
    }

    public function misPermiso(Request $request){ 
       
        $datos= new Datos();
        $user = $request->user();
        if (!$user) {
            $datos->id=1;
            $datos->mensaje="Error al listar Permiso, no token";  
            return response()->json($datos);
        }
        try{ 
            $rol= Roles::find($user->r_users_roles);
            $datos->id=0;
            $datos->mensaje="Listado de Permiso";
            if($rol->nombre=='admin') {
                $permiso = new Permisos();
                $permiso->nombre = 'ALL';
                $permiso->descripcion = 'ADMIN';            
                $rol->permisos->push($permiso); 
            }
            $datos->datos=$rol->permisos;
            $datos->datos_len=$rol->permisos->count();
        } 
        catch (\Exception $e) { 
            $datos->id=1;
            $datos->mensaje="Error al listar Roles\n".$e; 
        }
        return response()->json($datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }
 
    public function store(Request $request)
    {
        //
    }

   
    public function show(Roles $role)
    {  
        $roles = Roles::find($role->id);
        $datos= new Datos();
        try{
            $datos->id=0;
            $datos->mensaje="Roles #".$role->id; 
            $datos->datos=$roles->permisos;
            $datos->datos_len=1;
        } 
        catch (\Exception $e) { 
            $datos->id=1;
            $datos->mensaje="Error al buscar Rol {$role}\n".$e; 
        }
        return response()->json(($datos));
    }

    
    public function edit(Roles $roles)
    {
        //
    }

   
    public function update(Request $request, Roles $roles)
    {
        //
    }

   
    public function destroy(Roles $roles)
    {
        //
    }
}

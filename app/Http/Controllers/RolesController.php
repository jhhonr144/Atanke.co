<?php

namespace App\Http\Controllers;

use App\Models\Datos;
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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Roles  $roles
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Roles  $roles
     * @return \Illuminate\Http\Response
     */
    public function edit(Roles $roles)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Roles  $roles
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Roles $roles)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Roles  $roles
     * @return \Illuminate\Http\Response
     */
    public function destroy(Roles $roles)
    {
        //
    }
}
